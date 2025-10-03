<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use App\Models\Servicio;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PromocionController extends Controller
{
    /**
     * ✅ VALIDACIÓN PERSONALIZADA: Valor según tipo de promoción
     */
    private function getValidacionValorSegunTipo()
    {
        return function ($attribute, $value, $fail) {
            $request = request();
            $tipo = $request->tipo;

            if (!$tipo) {
                return; // Si no hay tipo, no validamos aquí
            }

            switch ($tipo) {
                case 'porcentaje':
                    if ($value < 5 || $value > 80) {
                        return $fail('Para promociones de porcentaje, el descuento debe estar entre 5% y 80%.');
                    }
                    break;

                case 'monto_fijo':
                    if ($value < 5 || $value > 3000) {
                        return $fail('Para promociones de monto fijo, el descuento debe estar entre L. 5 y L. 3000.');
                    }
                    break;

                case 'combo':
                    if ($value < 20 || $value > 5000) {
                        return $fail('Para combos, el precio debe estar entre L. 20 y L. 5000.');
                    }
                    break;
            }
        };
    }


    private function getValidacionFechasPromocion()
    {
        return function ($attribute, $value, $fail) {
            $request = request();
            $fechaInicio = $request->fecha_inicio;

            if (!$fechaInicio) {
                return;
            }

            try {
                $inicio = Carbon::parse($fechaInicio);
                $expiracion = Carbon::parse($value);
                $hoy = Carbon::today();



                // 2. No iniciar con más de 3 meses de anticipación
                if ($inicio->diffInMonths($hoy) > 3) {
                    return $fail('No puede programar promociones con más de 3 meses de anticipación.');
                }


                // 4. Duración máxima: 6 meses
                if ($expiracion->diffInMonths($inicio) > 6) {
                    return $fail('Las promociones no pueden durar más de 6 meses.');
                }

                // 5. No iniciar domingos (día cerrado o bajo flujo)
                if ($inicio->dayOfWeek === 0) {
                    return $fail('Las promociones no deben iniciar los domingos.');
                }



                // 7. Evitar iniciar en fechas problemáticas
                $mes = $inicio->month;
                $dia = $inicio->day;

                // No iniciar del 20-31 de diciembre (temporada navideña ocupada)
                if ($mes === 12 && $dia >= 20) {
                    return $fail('Evite iniciar promociones del 20 al 31 de diciembre (temporada navideña).');
                }

                // No iniciar en Semana Santa (varía, pero marzo/abril)
                // Simplificado: evitar última semana de marzo y primera de abril
                if (($mes === 3 && $dia >= 25) || ($mes === 4 && $dia <= 7)) {
                    return $fail('Evite iniciar promociones en Semana Santa (última semana marzo/primera abril).');
                }

                // 8. Validar duración según tipo de promoción
                $tipo = $request->tipo;
                if ($tipo === 'combo') {
                    // Combos: mínimo 1 semana, máximo 3 meses
                    $duracionDias = $expiracion->diffInDays($inicio);
                    if ($duracionDias < 7) {
                        return $fail('Los combos deben durar al menos 1 semana.');
                    }
                    if ($duracionDias > 90) {
                        return $fail('Los combos no deben durar más de 3 meses.');
                    }
                }

            } catch (\Exception $e) {
                return $fail('Error al validar las fechas.');
            }
        };
    }
    /**
     * ✅ VALIDACIÓN PERSONALIZADA: Monto mínimo lógico
     */
    private function getValidacionMontoMinimo()
    {
        return function ($attribute, $value, $fail) {
            $request = request();
            $tipo = $request->tipo;
            $valorPromocion = $request->valor;

            if (!$tipo || !$valorPromocion) {
                return;
            }

            // Para monto fijo, el monto mínimo debe ser mayor al descuento
            if ($tipo === 'monto_fijo' && $value > 0 && $value <= $valorPromocion) {
                return $fail('El monto mínimo debe ser mayor al valor del descuento para ser rentable.');
            }

            // Para porcentaje, validar que el monto mínimo sea lógico
            if ($tipo === 'porcentaje' && $value > 0) {
                $descuentoEstimado = ($value * $valorPromocion) / 100;
                if ($descuentoEstimado < 5) {
                    return $fail('Con este monto mínimo y porcentaje, el descuento sería menor a L. 5. Ajuste los valores.');
                }
            }
        };
    }

    /**
     * ✅ VALIDACIÓN PERSONALIZADA: Uso por cliente lógico
     */
    private function getValidacionUsoPorCliente()
    {
        return function ($attribute, $value, $fail) {
            $request = request();
            $usoMaximo = $request->uso_maximo;

            if (!$usoMaximo) {
                return;
            }

            // El uso por cliente no puede ser mayor al uso máximo total
            if ($value > $usoMaximo) {
                return $fail('El uso por cliente no puede ser mayor al uso máximo total.');
            }
        };
    }

    /**
     * ✅ VALIDACIÓN: Rentabilidad vs precios de servicios/productos
     */
    private function getValidacionRentabilidad()
    {
        return function ($attribute, $value, $fail) {
            $request = request();
            $tipo = $request->tipo;
            $valorPromocion = $request->valor;
            $montoMinimo = $request->monto_minimo;
            $aplicaA = $request->aplica_a;

            if (!$tipo || !$valorPromocion) {
                return;
            }


            $itemsIds = [];

            if ($tipo === 'combo' && $request->items_incluidos) {
                $items = explode(',', $request->items_incluidos);
                foreach ($items as $item) {
                    if (strpos($item, 's') === 0) {
                        $itemsIds['servicios'][] = (int)substr($item, 1);
                    } elseif (strpos($item, 'p') === 0) {
                        $itemsIds['productos'][] = (int)substr($item, 1);
                    }
                }
            } else {
                if ($aplicaA === 'servicios' && $request->servicios) {
                    $itemsIds['servicios'] = $request->servicios;
                } elseif ($aplicaA === 'productos' && $request->productos) {
                    $itemsIds['productos'] = $request->productos;
                }
            }

            // Solo validar si hay items seleccionados
            if (empty($itemsIds)) {
                return;
            }

            // Validar rentabilidad según el tipo
            if ($tipo === 'porcentaje') {
                $this->validarRentabilidadPorcentaje($valorPromocion, $montoMinimo, $itemsIds, $fail);
            } elseif ($tipo === 'monto_fijo') {
                $this->validarRentabilidadMontoFijo($valorPromocion, $montoMinimo, $itemsIds, $fail);
            } elseif ($tipo === 'combo') {
                $this->validarRentabilidadCombo($valorPromocion, $itemsIds, $fail);
            }
        };
    }

    /**
     * Validar rentabilidad para promociones de porcentaje
     */
    /**
     * Validar rentabilidad para promociones de porcentaje
     */
    /**
     * Validar rentabilidad para promociones de porcentaje
     */
    private function validarRentabilidadPorcentaje($porcentaje, $montoMinimo, $itemsIds, $fail)
    {
        $precioMinimo = PHP_INT_MAX;
        $precioMaximo = 0;

        if (isset($itemsIds['servicios'])) {
            $servicios = Servicio::whereIn('id', $itemsIds['servicios'])->get(['precio_base']);
            if ($servicios->isNotEmpty()) {
                $precioMinimo = min($precioMinimo, $servicios->min('precio_base'));
                $precioMaximo = max($precioMaximo, $servicios->max('precio_base'));
            }
        }

        if (isset($itemsIds['productos'])) {
            $productos = Producto::whereIn('id', $itemsIds['productos'])->get(['precio']);
            if ($productos->isNotEmpty()) {
                $precioMinimo = min($precioMinimo, $productos->min('precio'));
                $precioMaximo = max($precioMaximo, $productos->max('precio'));
            }
        }

        if ($precioMinimo === PHP_INT_MAX) {
            return;
        }

        // ✅ Descuento mínimo de L. 5 para ser atractivo
        $descuentoMinimo = ($precioMinimo * $porcentaje) / 100;
        if ($descuentoMinimo < 5) {
            $porcentajeSugerido = ceil((5 / $precioMinimo) * 100);
            return $fail("El {$porcentaje}% sobre el artículo más barato (L. {$precioMinimo}) solo da L. " . number_format($descuentoMinimo, 2) . " de descuento. Pruebe con {$porcentajeSugerido}% para dar al menos L. 5.");
        }

        // ✅ Máximo 50% de descuento
        if ($porcentaje > 50) {
            return $fail("El descuento no puede superar el 50%. Actualmente: {$porcentaje}%.");
        }

        // ✅ Debe quedar al menos 30% del precio original (margen de ganancia)
        $precioFinalMinimo = $precioMinimo * (1 - $porcentaje / 100);
        if ($precioFinalMinimo < ($precioMinimo * 0.30)) {
            $porcentajeMaximo = 70; // Máximo 70% de descuento = mínimo 30% de ganancia
            return $fail("El {$porcentaje}% de descuento deja el artículo más barato con menos del 30% de ganancia. Máximo permitido: {$porcentajeMaximo}%.");
        }

        // ✅ Si hay monto mínimo, validar lógica
        if ($montoMinimo > 0) {
            // Monto mínimo debe ser al menos 2x el precio del artículo más barato
            if ($montoMinimo < ($precioMinimo * 2)) {
                $montoSugerido = ceil($precioMinimo * 2);
                return $fail("El monto mínimo (L. {$montoMinimo}) debe ser al menos el doble del artículo más barato (L. {$precioMinimo}). Sugerido: L. {$montoSugerido}.");
            }

            // El descuento en el monto mínimo debe ser al menos L. 10 para ser atractivo
            $descuentoEnMontoMinimo = ($montoMinimo * $porcentaje) / 100;
            if ($descuentoEnMontoMinimo < 10) {
                return $fail("Con monto mínimo L. {$montoMinimo} y {$porcentaje}%, el descuento sería solo L. " . number_format($descuentoEnMontoMinimo, 2) . ". Poco atractivo (mínimo L. 10).");
            }
        }
    }

    /**
     * Validar rentabilidad para promociones de monto fijo
     */
    private function validarRentabilidadMontoFijo($descuento, $montoMinimo, $itemsIds, $fail)
    {
        $precioMinimo = PHP_INT_MAX;
        $precioMaximo = 0;

        if (isset($itemsIds['servicios'])) {
            $servicios = Servicio::whereIn('id', $itemsIds['servicios'])->get(['precio_base']);
            if ($servicios->isNotEmpty()) {
                $precioMinimo = min($precioMinimo, $servicios->min('precio_base'));
                $precioMaximo = max($precioMaximo, $servicios->max('precio_base'));
            }
        }

        if (isset($itemsIds['productos'])) {
            $productos = Producto::whereIn('id', $itemsIds['productos'])->get(['precio']);
            if ($productos->isNotEmpty()) {
                $precioMinimo = min($precioMinimo, $productos->min('precio'));
                $precioMaximo = max($precioMaximo, $productos->max('precio'));
            }
        }

        if ($precioMinimo === PHP_INT_MAX) {
            return;
        }

        // ✅ Descuento no puede ser mayor o igual al precio más barato
        if ($descuento >= $precioMinimo) {
            return $fail("El descuento (L. {$descuento}) no puede ser mayor o igual al precio del artículo más barato (L. {$precioMinimo}).");
        }

        // ✅ Descuento máximo: 50% del artículo más barato
        $descuentoMaximo = $precioMinimo * 0.50;
        if ($descuento > $descuentoMaximo) {
            return $fail("El descuento (L. {$descuento}) supera el 50% del artículo más barato (L. {$precioMinimo}). Máximo: L. " . number_format($descuentoMaximo, 2) . ".");
        }

        // ✅ Debe quedar al menos 30% del precio original
        $precioFinalMinimo = $precioMinimo - $descuento;
        $porcentajeRestante = ($precioFinalMinimo / $precioMinimo) * 100;
        if ($porcentajeRestante < 30) {
            $descuentoMaximoSeguro = $precioMinimo * 0.70; // Máximo 70% de descuento
            return $fail("El descuento (L. {$descuento}) deja el artículo más barato con solo " . number_format($porcentajeRestante, 1) . "% de su valor. Debe quedar al menos 30%. Máximo descuento: L. " . number_format($descuentoMaximoSeguro, 2) . ".");
        }

        // ✅ CRÍTICO: Validar rango de precios (evitar pérdidas en items baratos)
        // Si hay mucha diferencia entre el más barato y el más caro, es arriesgado
        if ($precioMaximo > ($precioMinimo * 3)) {
            return $fail("Los precios varían mucho (desde L. {$precioMinimo} hasta L. {$precioMaximo}). Con monto fijo puede perder dinero en los artículos baratos. Use promoción de PORCENTAJE o seleccione items con precios similares.");
        }

        // ✅ Monto mínimo debe ser al menos 2.5x el descuento (más estricto que porcentaje)
        if ($montoMinimo > 0 && $montoMinimo < ($descuento * 2.5)) {
            $montoSugerido = ceil($descuento * 2.5);
            return $fail("El monto mínimo (L. {$montoMinimo}) debe ser al menos 2.5 veces el descuento (L. {$descuento}). Sugerido: L. {$montoSugerido}.");
        }
    }

    /**
     * Validar rentabilidad para combos
     */
    private function validarRentabilidadCombo($precioCombo, $itemsIds, $fail)
    {
        $costoTotal = 0;
        $cantidadServicios = 0;
        $cantidadProductos = 0;

        if (isset($itemsIds['servicios'])) {
            $cantidadServicios = count($itemsIds['servicios']);
            $costoTotal += Servicio::whereIn('id', $itemsIds['servicios'])->sum('precio_base');
        }

        if (isset($itemsIds['productos'])) {
            $cantidadProductos = count($itemsIds['productos']);
            $costoTotal += Producto::whereIn('id', $itemsIds['productos'])->sum('precio');
        }

        if ($costoTotal === 0) {
            return;
        }

        $totalItems = $cantidadServicios + $cantidadProductos;

        // ✅ Precio del combo debe ser menor al costo total
        if ($precioCombo >= $costoTotal) {
            return $fail("El precio del combo (L. {$precioCombo}) debe ser menor al costo individual total (L. {$costoTotal}).");
        }

        // ✅ Calcular descuento real
        $descuentoReal = (($costoTotal - $precioCombo) / $costoTotal) * 100;

        // ✅ Descuento entre 10% y 45%
        if ($descuentoReal < 10) {
            $precioMaximo = $costoTotal * 0.90;
            return $fail("El combo ofrece solo " . number_format($descuentoReal, 1) . "% de descuento. Poco atractivo. Precio máximo sugerido: L. " . number_format($precioMaximo, 2) . " (10% descuento).");
        }
        if ($descuentoReal > 45) {
            $precioMinimo = $costoTotal * 0.55;
            return $fail("El combo ofrece " . number_format($descuentoReal, 1) . "% de descuento. Demasiado alto. Precio mínimo sugerido: L. " . number_format($precioMinimo, 2) . " (45% descuento).");
        }

        // ✅ Reglas según el tipo de items
        if ($cantidadProductos > 0) {
            // Combos con productos: precio mínimo 60% (productos tienen costo)
            $precioMinimo = $costoTotal * 0.60;
            if ($precioCombo < $precioMinimo) {
                return $fail("Los combos con productos deben costar al menos el 60% del total (L. " . number_format($precioMinimo, 2) . "). Actualmente: L. {$precioCombo}.");
            }
        } else {
            // Combos solo servicios: precio mínimo 55%
            $precioMinimo = $costoTotal * 0.55;
            if ($precioCombo < $precioMinimo) {
                return $fail("Los combos de servicios deben costar al menos el 55% del total (L. " . number_format($precioMinimo, 2) . "). Actualmente: L. {$precioCombo}.");
            }
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Actualizar automáticamente estado de expiradas
        Promocion::where('estado', 'activo')
            ->where('fecha_expiracion', '<', now())
            ->update(['estado' => 'inactivo']);

        $promociones = Promocion::orderBy('fecha_inicio', 'desc')
            ->orderBy('nombre')
            ->paginate(8);

        $tiposDisponibles = ['porcentaje', 'monto_fijo', 'combo'];
        $estadosDisponibles = ['activo', 'inactivo', 'expirado'];

        if ($request->ajax()) {
            return view('promociones.partials.tabla', compact('promociones'))->render();
        }

        $promociones = Promocion::orderBy('fecha_inicio', 'desc')
            ->orderBy('nombre')
            ->paginate(8);

        $tiposDisponibles = ['porcentaje', 'monto_fijo', 'combo'];
        $estadosDisponibles = ['activo', 'inactivo'];

        if ($request->ajax()) {
            return view('promociones.partials.tabla', compact('promociones'))->render();
        }

        return view('promociones.index', compact('promociones', 'tiposDisponibles', 'estadosDisponibles'));
    }

    /**
     * ✅ BÚSQUEDA MEJORADA
     */
    public function buscar(Request $request)
    {
        $totalGeneral = Promocion::count();
        $query = Promocion::query();

        // Búsqueda por nombre
        if ($request->buscar) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'LIKE', '%' . $request->buscar . '%');
            });
        }

        // Filtros específicos
        if ($request->tipo) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->estado) {
            $query->where('estado', $request->estado);
        }

        // Filtro de promociones vigentes/expiradas
        if ($request->vigencia === 'vigente') {
            $query->where('fecha_inicio', '<=', now())
                ->where('fecha_expiracion', '>=', now())
                ->where('estado', 'activo');
        } elseif ($request->vigencia === 'expirada') {
            $query->where('fecha_expiracion', '<', now());
        }

        // Filtros de fecha
        if ($request->fecha_desde) {
            $query->where('fecha_inicio', '>=', $request->fecha_desde);
        }

        if ($request->fecha_hasta) {
            $query->where('fecha_expiracion', '<=', $request->fecha_hasta);
        }

        $totalFiltrado = $query->count();
        $promociones = $query->orderBy('fecha_inicio', 'desc')
            ->orderBy('nombre')
            ->paginate(8);

        return response()->json([
            'tabla' => view('promociones.partials.tabla', compact('promociones'))->render(),
            'totalFiltrado' => $totalFiltrado,
            'totalGeneral' => $totalGeneral,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servicios = Servicio::where('estado', 'activo')
            ->orderBy('categoria_servicio')
            ->orderBy('nombre_servicio')
            ->get();


        $productos = Producto::where('estado', 'activo')
            ->orderBy('categoria_producto')
            ->orderBy('nombre_producto')
            ->get();

        return view('promociones.create', compact('servicios', 'productos'));
    }

    /**
     * ✅ STORE COMPLETAMENTE MEJORADO CON NUEVOS CAMPOS Y VALIDACIÓN CORREGIDA
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => [
                'required',
                'string',
                'min:5',
                'max:50',
                'regex:/^[\pL\s\d\-\%\+]+$/u',
                Rule::unique('promocions', 'nombre')
            ],
            'tipo' => 'required|in:porcentaje,monto_fijo,combo',
            'aplica_a' => 'required|in:productos,servicios',
            'descripcion' => [
                'required',
                'string',
                'min:10',
                'max:200',
                'regex:/^[\pL\s\d\.\,\-\%\+\(\)]+$/u'
            ],
            'valor' => [
                'required',
                'integer',
                'min:5',
                $this->getValidacionValorSegunTipo()
            ],
            'fecha_inicio' => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:' . now()->addMonths(3)->toDateString(),
                function ($attribute, $value, $fail) {
                    $fecha = Carbon::parse($value);

                    if ($fecha->dayOfWeek === 0) {
                        return $fail('Las promociones no pueden iniciar los domingos.');
                    }

                    if ($fecha->month === 12 && $fecha->day >= 20) {
                        return $fail('Evite iniciar promociones del 20-31 de diciembre.');
                    }

                    if (($fecha->month === 3 && $fecha->day >= 25) || ($fecha->month === 4 && $fecha->day <= 7)) {
                        return $fail('Evite iniciar promociones en Semana Santa.');
                    }
                }
            ],
            'fecha_expiracion' => [
                'required',
                'date',
                'after:fecha_inicio',
                'before_or_equal:' . now()->addMonths(6)->toDateString(), // ✅ Máximo 6 meses desde HOY
                function ($attribute, $value, $fail) use ($request) {
                    if (!$request->fecha_inicio) {
                        return;
                    }

                    $inicio = Carbon::parse($request->fecha_inicio);
                    $expiracion = Carbon::parse($value);

                    // ✅ Validar que no exceda 6 meses desde la fecha de inicio
                    if ($expiracion->diffInMonths($inicio) > 6) {
                        return $fail('La promoción no puede durar más de 6 meses desde su fecha de inicio.');
                    }



                },
                $this->getValidacionFechasPromocion()
            ],
            'monto_minimo' => [
                'required',
                'integer',
                'min:0',
                'max:5000',
                $this->getValidacionMontoMinimo()
            ],
            'uso_maximo' => [
                'required',
                'integer',
                'min:1',
                'max:9999'
            ],
            'uso_por_cliente' => [
                'required',
                'integer',
                'min:1',
                'max:100',
                $this->getValidacionUsoPorCliente()
            ],
            'combinable' => 'required|in:si,no',
        ];

        if ($request->tipo === 'combo') {
            $rules['items_incluidos'] = [
                'required',
                'string',
                'max:500',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        return $fail('Debe especificar los servicios/productos incluidos en el combo.');
                    }
                    if (!preg_match('/^[sp]\d+(,[sp]\d+)*$/', $value)) {
                        return $fail('Formato de items inválido.');
                    }
                    $items = explode(',', $value);

                    if (count($items) < 2) {
                        return $fail('Un combo debe incluir al menos 2 items.');
                    }
                    if (count($items) > 7) {
                        return $fail('Un combo no puede incluir más de 7 items.');
                    }
                }
            ];
        } else {
            if ($request->aplica_a === 'servicios') {
                // Porcentaje: hasta 15 items | Monto fijo: hasta 5 items
                $maxItems = $request->tipo === 'porcentaje' ? 15 : 5;
                $rules['servicios'] = "required|array|min:1|max:{$maxItems}";
                $rules['servicios.*'] = 'exists:servicios,id';
            } elseif ($request->aplica_a === 'productos') {
                $maxItems = $request->tipo === 'porcentaje' ? 15 : 5;
                $rules['productos'] = "required|array|min:1|max:{$maxItems}";
                $rules['productos.*'] = 'exists:productos,id';
            }
        }

        $messages = [
            // NOMBRE
            'nombre.required' => 'El nombre de la promoción es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto válido.',
            'nombre.min' => 'El nombre debe tener al menos 5 caracteres.',
            'nombre.max' => 'El nombre no puede exceder 50 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras, números, espacios, guiones y el símbolo %.',
            'nombre.unique' => 'Ya existe una promoción con este nombre.',

            // TIPO Y APLICA_A
            'tipo.required' => 'Debe seleccionar un tipo de promoción.',
            'tipo.in' => 'El tipo de promoción no es válido. Debe ser: porcentaje, monto fijo o combo.',
            'aplica_a.required' => 'Debe especificar si la promoción aplica a productos o servicios.',
            'aplica_a.in' => 'El campo "aplica a" debe ser productos o servicios.',

            // DESCRIPCIÓN
            'descripcion.required' => 'La descripción de la promoción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto válido.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción no puede exceder 200 caracteres.',
            'descripcion.regex' => 'La descripción contiene caracteres no permitidos.',

            // VALOR
            'valor.required' => 'Debe especificar el valor de la promoción.',
            'valor.integer' => 'El valor debe ser un número entero.',
            'valor.min' => 'El valor debe ser mayor a cero.',

            // FECHAS
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'Ingrese una fecha de inicio válida.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy.',
            'fecha_inicio.before_or_equal' => 'No puede programar promociones con más de 3 meses de anticipación.',

            'fecha_expiracion.required' => 'La fecha de expiración es obligatoria.',
            'fecha_expiracion.date' => 'Ingrese una fecha de expiración válida.',
            'fecha_expiracion.after' => 'La fecha de expiración debe ser posterior a la fecha de inicio.',
            'fecha_expiracion.before_or_equal' => 'La fecha de expiración no puede ser mayor a 6 meses desde hoy.',

            // MONTO MÍNIMO
            'monto_minimo.required' => 'Debe especificar el monto mínimo (use 0 si no aplica).',
            'monto_minimo.integer' => 'El monto mínimo debe ser un número entero.',
            'monto_minimo.min' => 'El monto mínimo no puede ser negativo.',
            'monto_minimo.max' => 'El monto mínimo no puede superar L. 5000.',

            // CONTROL DE USO
            'uso_maximo.required' => 'El uso máximo total es obligatorio.',
            'uso_maximo.integer' => 'El uso máximo debe ser un número entero.',
            'uso_maximo.min' => 'El uso máximo debe ser al menos 1.',
            'uso_maximo.max' => 'El uso máximo no puede superar 9999.',
            'uso_por_cliente.required' => 'El uso por cliente es obligatorio.',
            'uso_por_cliente.integer' => 'El uso por cliente debe ser un número entero.',
            'uso_por_cliente.min' => 'El uso por cliente debe ser al menos 1.',
            'uso_por_cliente.max' => 'El uso por cliente no puede superar 100.',
            'combinable.required' => 'Debe especificar si la promoción es combinable.',
            'combinable.in' => 'El campo combinable debe ser "si" o "no".',


            // ITEMS INCLUIDOS (COMBOS)
            'items_incluidos.required' => 'Debe especificar los servicios/productos incluidos en el combo.',
            'items_incluidos.string' => 'Los items incluidos deben ser texto válido.',
            'items_incluidos.max' => 'La lista de items es muy larga. Máximo 500 caracteres.',

            'servicios.max' => 'No puede seleccionar más de 10 servicios para una promoción.',
            'productos.max' => 'No puede seleccionar más de 10 productos para una promoción.',
            'servicios.required' => 'Debe seleccionar al menos un servicio.',
            'servicios.array' => 'La selección de servicios no es válida.',
            'servicios.min' => 'Debe seleccionar al menos un servicio.',
            'servicios.*.exists' => 'Uno o más servicios seleccionados no existen.',
            'productos.required' => 'Debe seleccionar al menos un producto.',
            'productos.array' => 'La selección de productos no es válida.',
            'productos.min' => 'Debe seleccionar al menos un producto.',
            'productos.*.exists' => 'Uno o más productos seleccionados no existen.',
        ];

        // Validación de conflictos
        $request->validate([
            'conflicto_fechas' => [
                function ($attribute, $value, $fail) use ($request) {
                    $conflicto = Promocion::where('tipo', $request->tipo)
                        ->where('estado', 'activo')
                        ->where(function ($query) use ($request) {
                            $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_expiracion])
                                ->orWhereBetween('fecha_expiracion', [$request->fecha_inicio, $request->fecha_expiracion])
                                ->orWhere(function ($q) use ($request) {
                                    $q->where('fecha_inicio', '<=', $request->fecha_inicio)
                                        ->where('fecha_expiracion', '>=', $request->fecha_expiracion);
                                });
                        })
                        ->exists();

                    if ($conflicto) {
                        return $fail('Ya existe una promoción activa del mismo tipo en ese período de tiempo.');
                    }
                }
            ]
        ], ['conflicto_fechas' => '']);

        $validated = $request->validate($rules, $messages);
        $validated['estado'] = 'activo';

        $promocion = Promocion::create($validated);

        // CAMBIO: Guardar items en tabla pivot Y en items_incluidos
        if ($validated['tipo'] === 'combo') {
            $items = explode(',', $validated['items_incluidos']);
            $servicioIds = [];
            $productoIds = [];

            foreach ($items as $item) {
                if (strpos($item, 's') === 0) {
                    $servicioIds[] = (int)substr($item, 1);
                } elseif (strpos($item, 'p') === 0) {
                    $productoIds[] = (int)substr($item, 1);
                }
            }

            if (!empty($servicioIds)) {
                $promocion->servicios()->sync($servicioIds);
            }
            if (!empty($productoIds)) {
                $promocion->productos()->sync($productoIds);
            }
        } else {
            if ($validated['aplica_a'] === 'servicios' && isset($validated['servicios'])) {
                $promocion->servicios()->sync($validated['servicios']);
                $promocion->update(['items_incluidos' => implode(',', $validated['servicios'])]);
            } elseif ($validated['aplica_a'] === 'productos' && isset($validated['productos'])) {
                $promocion->productos()->sync($validated['productos']);
                $promocion->update(['items_incluidos' => implode(',', $validated['productos'])]);
            }
        }

        return redirect()->route('promociones.index')
            ->with('success', 'Promoción creada exitosamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Promocion $promocion)
    {
        // Cargar relaciones según aplica_a
        if ($promocion->aplica_a === 'servicios') {
            $promocion->load(['servicios']);
        } else {
            $promocion->load(['productos']);
        }

        // ✅ CALCULAR INFORMACIÓN ADICIONAL
        $esVigente = $promocion->fecha_inicio <= now() &&
            $promocion->fecha_expiracion >= now() &&
            $promocion->estado === 'activo';

        $diasRestantes = $esVigente ?
            now()->diffInDays($promocion->fecha_expiracion, false) : null;

        // ✅ CALCULAR USO ACTUAL
        $usoActual = $promocion->clientes()->sum('promocion_cliente.usos');
        $clientesQueUsaron = $promocion->clientes()->count();

        return view('promociones.show', compact('promocion', 'esVigente', 'diasRestantes', 'usoActual', 'clientesQueUsaron'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promocion $promocion)
    {

    }

    /**
     * ✅ UPDATE MEJORADO CON NUEVOS CAMPOS
     */
    public function update(Request $request, Promocion $promocion)
    {

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promocion $promocion)
    {

    }
}