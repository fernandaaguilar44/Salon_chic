<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ClienteController extends Controller
{
    private function getValidacionIdentidadCliente()
    {
        $municipiosPorDepto = [
            '01' => 18, '02' => 28, '03' => 21, '04' => 16, '05' => 23,
            '06' => 16, '07' => 19, '08' => 28, '09' => 16, '10' => 28,
            '11' => 12, '12' => 28, '13' => 28, '14' => 23, '15' => 28,
            '16' => 28, '17' => 28, '18' => 28,
        ];

        return function ($attribute, $value, $fail) use ($municipiosPorDepto) {
            $value = preg_replace('/[\s-]/', '', $value);

            if (!preg_match('/^\d{13}$/', $value)) {
                return $fail('El número de identidad debe contener exactamente 13 dígitos numéricos.');
            }

            $departamento = substr($value, 0, 2);
            $municipio = intval(substr($value, 2, 2));
            $anio = substr($value, 4, 4);
            $correlativo = substr($value, 8, 5);

            // Departamento válido
            if (!array_key_exists($departamento, $municipiosPorDepto)) {
                return $fail('Por favor, verifica tu número de identidad. El código de departamento no es válido.');
            }

            // Municipio válido
            if ($municipio < 1 || $municipio > $municipiosPorDepto[$departamento]) {
                return $fail('El municipio en tu identidad no corresponde al departamento. Revisa los números por favor.');
            }

            // Año de inscripción realista
            $anioNumerico = intval($anio);
            $anioActual = intval(date('Y'));
            $anioMinimo = $anioActual - 90;  // Permite inscripciones hasta 90 años atrás
            $anioMaximo = $anioActual;

            if ($anioNumerico < $anioMinimo || $anioNumerico > $anioMaximo) {
                return $fail('El año de inscripción en tu identidad no es válido. Verifica los números.');
            }

            // Todos los dígitos iguales
            if (preg_match('/^(.)\1{12}$/', $value)) {
                return $fail('Tu número de identidad no puede tener todos los dígitos iguales.');
            }

            // Correlativo válido
            if ($correlativo === '00000') {
                return $fail('Tu número de identidad no es válido. Revisa los últimos 5 dígitos.');
            }
        };
    }


    public function index(Request $request)
    {
        $clientes = Cliente::orderBy('nombre')->paginate(8);
        $sexosDisponibles = Cliente::select('sexo')->distinct()->whereNotNull('sexo')->pluck('sexo');

        // Si la petición es AJAX (por paginación con JS), devuelve solo la tabla
        if ($request->ajax()) {
            return view('clientes.partials.tabla', compact('clientes'))->render();
        }

        // Vista completa si no es AJAX
        return view('clientes.index', compact('clientes', 'sexosDisponibles'));

    }

    public function buscar(Request $request)
    {
        $buscar = $request->buscar;
        $sexo = $request->sexo;

        $totalGeneral = Cliente::count();

        $query = Cliente::query();

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('telefono', 'LIKE', '%' . $buscar . '%'); // Cambiar identidad por teléfono
            });
        }

        if ($sexo) {
            $query->where('sexo', $sexo);
        }

        $totalFiltrado = $query->count();

        $clientes = $query->orderBy('nombre')->paginate(8);

        return response()->json([
            'tabla' => view('clientes.partials.tabla', compact('clientes'))->render(),
            'totalFiltrado' => $totalFiltrado,
            'totalGeneral' => $totalGeneral,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'telefono' => [
                'required',
                'regex:/^[23789]\d{7}$/',
                'not_regex:/^0+$/',
                'not_regex:/^(\d)\1{7}$/',
                'unique:clientes,telefono'
            ],
            'identidad' => [
                'required',
                'digits:13',
                'not_regex:/^0+$/',
                'unique:clientes,identidad',  $this->getValidacionIdentidadCliente() // ← Aquí lo agregas
            ],
            'fecha_nacimiento' => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . now()->subYears(90)->toDateString(),
            ],
            'sexo' => ['required', 'in:masculino,femenino'],
            'correo' => [ 'required',
                'email',
                'max:50',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'unique:clientes,correo'
            ],
            'direccion' => [ 'required','string', 'max:200', 'regex:/^[\pL0-9\s.,#\-]+$/u'],
        ];

        $messages = [
            // NOMBRE
            'nombre.required' => 'Debe ingresar el nombre completo del cliente.',
            'nombre.string' => 'El nombre del cliente debe ser texto válido.',
            'nombre.max' => 'El nombre del cliente no puede exceder 50 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            // TELÉFONO
            'telefono.required' => 'Debe ingresar un número de teléfono.',
            'telefono.regex' => 'El teléfono debe comenzar con 2, 3, 7, 8 o 9 y contener 8 dígitos en total.',
            'telefono.not_regex' => 'El teléfono no puede ser solo ceros ni números repetidos.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',

            // IDENTIDAD
            'identidad.required' => 'El número de identidad es obligatorio.',
            'identidad.digits' => 'El número de identidad debe contener exactamente 13 dígitos.',
            'identidad.not_regex' => 'El número de identidad no puede ser solo ceros.',
            'identidad.unique' => 'El número de identidad ya está registrado en el sistema.',

            // FECHA DE NACIMIENTO
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a la fecha actual.',
            'fecha_nacimiento.after_or_equal' => 'La fecha de nacimiento no puede ser anterior a hace 90 años.',

            // SEXO
            'sexo.required' => 'Debe seleccionar el sexo del cliente.',
            'sexo.in' => 'El sexo seleccionado no es válido.',

            // CORREO
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe tener un formato válido.',
            'correo.max' => 'El correo no puede superar los 50 caracteres.',
            'correo.regex' => 'El correo electrónico tiene un formato inválido.',
            'correo.unique' => 'El correo electrónico ya está registrado.',

            // DIRECCIÓN
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.string' => 'La dirección debe ser texto válido.',
            'direccion.max' => 'La dirección no puede exceder 200 caracteres.',
            'direccion.regex' => 'La dirección contiene caracteres inválidos.',
        ];

        $validated = $request->validate($rules, $messages);

        Cliente::create($validated);

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'],
            'telefono' => [
                'required',
                'regex:/^[23789]\d{7}$/',
                'not_regex:/^0+$/',
                'not_regex:/^(\d)\1{7}$/',
                Rule::unique('clientes', 'telefono')->ignore($cliente->id)
            ],
            'identidad' => [
                'required',
                'digits:13',
                'not_regex:/^0+$/',
                Rule::unique('clientes', 'identidad')->ignore($cliente->id),
                $this->getValidacionIdentidadCliente() // ← Aquí lo agregas
            ],
            'fecha_nacimiento' => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:' . now()->subYears(90)->toDateString(),
            ],
            'sexo' => ['required', 'in:masculino,femenino'],
            'correo' => [
                'required',
                'email',
                'max:50',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                Rule::unique('clientes', 'correo')->ignore($cliente->id)
            ],
            'direccion' => ['required', 'string', 'max:200', 'regex:/^[\pL0-9\s.,#\-]+$/u'],
        ];

        $messages = [
            // Mensajes personalizados (igual que antes)
            'nombre.required' => 'Debe ingresar el nombre completo del cliente.',
            'nombre.string' => 'El nombre del cliente debe ser texto válido.',
            'nombre.max' => 'El nombre del cliente no puede exceder 50 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            'telefono.required' => 'Debe ingresar un número de teléfono.',
            'telefono.regex' => 'El teléfono debe comenzar con 2, 3, 7, 8 o 9 y contener 8 dígitos en total.',
            'telefono.not_regex' => 'El teléfono no puede ser solo ceros ni números repetidos.',
            'telefono.unique' => 'El número de teléfono ya está registrado.',

            'identidad.required' => 'El número de identidad es obligatorio.',
            'identidad.digits' => 'El número de identidad debe contener exactamente 13 dígitos.',
            'identidad.not_regex' => 'El número de identidad no puede ser solo ceros.',
            'identidad.unique' => 'El número de identidad ya está registrado en el sistema.',

            // FECHA DE NACIMIENTO
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a la fecha actual.',
            'fecha_nacimiento.after_or_equal' => 'La fecha de nacimiento no puede ser anterior a hace 100 años.',

            'sexo.required' => 'Debe seleccionar el sexo del cliente.',
            'sexo.in' => 'El sexo seleccionado no es válido.',

            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe tener un formato válido.',
            'correo.max' => 'El correo no puede superar los 50 caracteres.',
            'correo.regex' => 'El correo electrónico tiene un formato inválido.',
            'correo.unique' => 'El correo electrónico ya está registrado.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.string' => 'La dirección debe ser texto válido.',
            'direccion.max' => 'La dirección no puede exceder 200 caracteres.',
            'direccion.regex' => 'La dirección contiene caracteres inválidos.',
        ];

        // Validación
        $validatedData = $request->validate($rules, $messages);

        // Actualizar cliente
        $cliente->update($validatedData);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
