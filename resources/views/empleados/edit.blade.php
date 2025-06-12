<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar empleado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #E6E6FA; /* Lavanda */
            color: white;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            color: black;
            max-width: 900px;
        }
        .form-label {
            color: #E4007C;
        }
        .btn-custom {
            background-color: #E4007C;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #c3006a;
        }
        .form-control:invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            display: none;
        }

        .was-validated .form-control:invalid ~ .invalid-feedback,
        .was-validated .form-select:invalid ~ .invalid-feedback,
        .form-control.is-invalid ~ .invalid-feedback,
        .form-select.is-invalid ~ .invalid-feedback {
            display: block;
        }

    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center" style="color: #4B0082;">Editar empleado</h2>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <form method="POST" action="{{ route('empleados.update', $empleado->id) }}" id="editarEmpleadoForm">

        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nombre_empleado" class="form-label">Nombre completo</label>
                <input type="text" id="nombre_empleado" name="nombre_empleado" class="form-control @error('nombre_empleado') is-invalid @enderror"
                       value="{{ old('nombre_empleado', $empleado->nombre_empleado) }}" required maxlength="30"
                       onkeypress="return soloLetras(event)" onpaste="return false" />
                @error('nombre_empleado')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="numero_identidad" class="form-label">Número de identidad</label>
                <input type="text" id="numero_identidad" name="numero_identidad" class="form-control" value="{{ $empleado->numero_identidad }}" readonly />

            </div>

            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" pattern="[1-9][0-9]{7}" id="telefono" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                       value="{{ old('telefono', $empleado->telefono) }}" required maxlength="8" minlength="8"
                       onkeypress="return validarNumeroSinCeroInicio(event)" onpaste="return false" autocomplete="off" />
                @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                       value="{{ old('direccion', $empleado->direccion) }}" required maxlength="35" />
                @error('direccion')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="salario" class="form-label">Salario</label>
                <input type="number"  id="salario" name="salario" class="form-control @error('salario') is-invalid @enderror"
                       value="{{ old('salario', $empleado->salario) }}" required min="10000" max="20000" step="0.01"   onkeypress="return soloNumeros(event)"
                       placeholder="000000.00"
                       oninput="limitarSalario(this)" />
                @error('salario')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="contacto_emergencia" class="form-label">Teléfono del contacto</label>
                <input type="text" pattern="[1-9][0-9]{7}" id="contacto_emergencia" name="contacto_emergencia" class="form-control @error('contacto_emergencia') is-invalid @enderror"
                       value="{{ old('contacto_emergencia', $empleado->contacto_emergencia) }}" required maxlength="8" minlength="8"
                       onkeypress="return validarNumeroSinCeroInicio(event)" onpaste="return false" autocomplete="off" />
                @error('contacto_emergencia')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="col-md-6">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" id="correo" name="correo" class="form-control @error('correo') is-invalid @enderror"
                       value="{{ old('correo', $empleado->correo) }}" readonly />
            </div>

            <div class="col-md-6">
                <label for="cargo" class="form-label">Cargo</label>
                <select id="cargo" name="cargo" class="form-select @error('cargo') is-invalid @enderror" required>
                    <option value="">Seleccione un cargo</option>
                    <option value="estilista" {{ old('cargo', $empleado->cargo) == 'estilista' ? 'selected' : '' }}>Estilista</option>
                    <option value="manicurista" {{ old('cargo', $empleado->cargo) == 'manicurista' ? 'selected' : '' }}>Manicurista</option>
                    <!-- Puedes agregar más opciones si lo necesitas -->
                </select>
                @error('cargo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="estado" class="form-label">Estado</label>
                <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                    <option value="">Seleccione estado</option>
                    <option value="activo" {{ old('estado', $empleado->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado', $empleado->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" class="form-control @error('fecha_ingreso') is-invalid @enderror"
                       value="{{ old('fecha_ingreso', $empleado->fecha_ingreso) }}" required max="{{ date('Y-m-d') }}" />
                @error('fecha_ingreso')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-custom">Guardar cambios</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function soloLetras(e) {
        let key = e.keyCode || e.which;
        let tecla = String.fromCharCode(key).toLowerCase();
        let letras = " áéíóúabcdefghijklmnñopqrstuvwxyz"; // sin espacio
        let especiales = [8, 37, 39, 46]; // backspace, flechas, suprimir

        let input = e.target;

        // Evitar caracteres especiales, punto y comilla simple
        if (tecla === '.' || tecla === "'" || (letras.indexOf(tecla) === -1 && !especiales.includes(key))) {
            e.preventDefault();
            return false;
        }

        // No permitir espacio como primer carácter
        if (key === 32 && input.selectionStart === 0) {
            e.preventDefault();
            return false;
        }

        // No permitir múltiples espacios seguidos
        if (key === 32) {
            const valor = input.value;
            const posicion = input.selectionStart;

            // Si hay un espacio antes de la posición actual
            if (valor.charAt(posicion - 1) === ' ') {
                e.preventDefault();
                return false;
            }
        }

        return true;
    }



    function limitarSalario(input) {
        let valor = input.value;

        // Eliminar todo excepto dígitos y punto
        valor = valor.replace(/[^0-9.]/g, '');

        // Dividir parte entera y decimal
        let partes = valor.split('.');

        // Limitar parte entera a 6 dígitos
        if (partes[0].length > 6) {
            partes[0] = partes[0].substring(0, 6);
        }

        // Limitar parte decimal a 2 dígitos si existe
        if (partes[1]) {
            partes[1] = partes[1].substring(0, 2);
            input.value = partes[0] + '.' + partes[1];
        } else {
            input.value = partes[0];
        }
    }

    function soloNumeros(e) {
        const permitido = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Delete'];
        if (/\d/.test(e.key) || permitido.includes(e.key)) {
            return true;
        }

        // Permitir el punto si no existe aún
        if (e.key === '.' && !e.target.value.includes('.')) {
            return true;
        }

        e.preventDefault();
        return false;
    }


    // Permite números pero no espacio ni que inicie con 0
    function validarNumeroSinCeroInicio(e) {
        let key = e.keyCode || e.which;

        if ([8, 37, 39, 46].includes(key)) return true;

        let input = e.target;
        let char = String.fromCharCode(key);

        if (key === 32) {
            e.preventDefault();
            return false;
        }

        if (input.value.length === 0 && !/[1-9]/.test(char)) {
            e.preventDefault();
            return false;
        }

        if (input.value.length > 0 && !/[0-9]/.test(char)) {
            e.preventDefault();
            return false;
        }

        return true;
    }

    // Validación al enviar el formulario
    document.getElementById('empleadoForm').addEventListener('submit', function (event) {
        const form = event.target;

        // Limpiar errores anteriores
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        let valido = true;




        // Validar nombre_empleado (mínimo 3 letras, máximo 25 caracteres, solo letras y espacios, sin puntos)
        const nombre = form.nombre_empleado.value.trim();
        const letrasNombre = nombre.replace(/\s+/g, ''); // Eliminar espacios para contar solo letras

        form.nombre_empleado.classList.remove('is-invalid');

        if (
            !nombre ||
            nombre.length > 25 ||
            letrasNombre.length < 3 ||
            !/^[a-záéíóúñÑÁÉÍÓÚ\s]+$/i.test(nombre) // Solo letras y espacios
        ) {
            form.nombre_empleado.classList.add('is-invalid');
            valido = false;
        }





        function validarNumeroIdentidad(form) {
            const identidad = form.numero_identidad.value.trim();

            const codigosValidos = [
                "0101","0102","0103","0104","0105","0106","0107","0108",
                "0201","0202","0203","0204","0205","0206","0207","0208","0209","0210",
                "0301","0302","0303","0304","0305","0306","0307","0308","0309","0310","0311","0312",
                "0313","0314","0315","0316","0317","0318","0319","0320","0321",
                "0401","0402","0403","0404","0405","0406","0407","0408","0409","0410","0411","0412","0413","0414","0415","0416","0417","0418","0419","0420","0421","0422","0423",
                "0501","0502","0503","0504","0505","0506","0507","0508","0509","0510","0511","0512",
                "0601","0602","0603","0604","0605","0606","0607","0608","0609","0610","0611","0612","0613","0614","0615","0616",
                "0701","0702","0703","0704","0705","0706","0707","0708","0709","0710","0711","0712","0713","0714","0715","0716","0717","0718","0719",
                "0801","0802","0803","0804","0805","0806","0807","0808","0809","0810","0811","0812","0813","0814","0815","0816","0817","0818","0819","0820","0821","0822","0823","0824","0825","0826","0827","0828",
                "0901","0902","0903","0904","0905","0906",
                "1001","1002","1003","1004","1005","1006","1007","1008","1009","1010","1011","1012","1013","1014","1015","1016","1017",
                "1101","1102","1103","1104",
                "1201","1202","1203","1204","1205","1206","1207","1208","1209","1210","1211","1212","1213","1214","1215","1216","1217","1218","1219",
                "1301","1302","1303","1304","1305","1306","1307","1308","1309","1310","1311","1312","1313","1314","1315","1316","1317","1318","1319","1320","1321","1322","1323","1324","1325","1326","1327","1328",
                "1401","1402","1403","1404","1405","1406","1407","1408","1409","1410","1411","1412","1413","1414","1415","1416",
                "1501","1502","1503","1504","1505","1506","1507","1508","1509","1510","1511","1512","1513","1514","1515","1516","1517","1518","1519","1520","1521","1522","1523",
                "1601","1602","1603","1604","1605","1606","1607","1608","1609","1610","1611","1612","1613","1614","1615","1616","1617","1618","1619","1620","1621","1622","1623","1624","1625","1626","1627","1628",
                "1701","1702","1703","1704","1705","1706","1707","1708","1709",
                "1801","1802","1803","1804","1805","1806","1807","1808","1809","1810","1811"
            ];

            let validos = true;
            form.numero_identidad.classList.remove('is-invalid');

            // Validar longitud exacta y solo números
            if (!/^\d{13}$/.test(identidad)) {
                validos = false;
            }

            // Validar que los primeros 4 dígitos estén en la lista
            const primeros4 = identidad.substring(0, 4);
            if (!codigosValidos.includes(primeros4)) {
                validos = false;
            }

            // Validar que no sean todos ceros
            if (/^0+$/.test(identidad)) {
                validos = false;
            }

            if (!validos) {
                form.numero_identidad.classList.add('is-invalid');
                return false;
            }

            return true;
        }


        document.getElementById('empleadoForm').addEventListener('submit', function (event) {
            const form = event.target;

            // Limpiar errores anteriores
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            let valido = true;

            // Validar número de identidad
            if (!validarNumeroIdentidad(form)) {
                valido = false;
            }

            // Otras validaciones...

            if (!valido) {
                event.preventDefault();
            }
        });






        // Validar telefono (8 dígitos, no espacios, no ceros iniciales)
        const telefono = form.telefono.value.trim();
        if (!/^[23789]\d{7}$/.test(telefono)) {
            form.telefono.classList.add('is-invalid');
            valido = false;
        }

        // Validar dirección (no vacía ni solo espacios, max 100)
        const direccion = form.direccion.value.trim();
        if (!direccion || direccion.length > 100) {
            form.direccion.classList.add('is-invalid');
            valido = false;
        }

        // Validar salario
        const salario = parseFloat(form.salario.value.trim());
        const salarioMinimo = 10000; // Puedes cambiar este valor según el sector
        const salarioMaximo = 200000; // Límite superior razonable

        form.salario.classList.remove('is-invalid');

        if (
            isNaN(salario) ||                // No es número válido
            salario < salarioMinimo ||       // Menor al mínimo permitido
            salario > salarioMaximo ||       // Excesivamente alto (posible error)
            /^0+(\.0+)?$/.test(form.salario.value.trim()) // Solo ceros
        ) {
            form.salario.classList.add('is-invalid');
            validos = false;
        }


        // Validar contacto_emergencia (8 dígitos, no ceros, no espacios)
        const contacto = form.contacto_emergencia.value.trim();
        if (!/^[23789]\d{7}$/.test(contacto)) {
            form.contacto_emergencia.classList.add('is-invalid');
            valido = false;
        }



        const correo = form.correo.value.trim();

// Expresión para correos válidos: empieza con letra, sin espacios ni doble punto
        const emailRegex = /^[a-zA-Z](?!.*\.\.)[a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        form.correo.classList.remove('is-invalid');

// Validar que no tenga espacios
        const contieneEspacios = /\s/.test(correo);

        if (!emailRegex.test(correo) || contieneEspacios) {
            form.correo.classList.add('is-invalid');
            valido = false;
        }


        // Validar cargo (solo letras y espacios, no solo espacios, max 50)
        const cargo = form.cargo.value.trim();
        if (!cargo || cargo.length > 50 || !/^[a-záéíóúñ]+(?:\s[a-záéíóúñ]+)*$/i.test(cargo)) {
            form.cargo.classList.add('is-invalid');
            valido = false;
        }

        // Validar fecha_ingreso (no vacía, no futura)
        const fechaIngreso = form.fecha_ingreso.value;
        const hoy = new Date().toISOString().split('T')[0];
        if (!fechaIngreso || fechaIngreso > hoy) {
            form.fecha_ingreso.classList.add('is-invalid');
            valido = false;
        }

        // Validar estado (activo/inactivo)
        if (!['activo', 'inactivo'].includes(form.estado.value)) {
            form.estado.classList.add('is-invalid');
            valido = false;
        }

        if (!valido) {
            event.preventDefault();
            event.stopPropagation();
        }
    });
    document.getElementById('editarEmpleadoForm').addEventListener('submit', function () {
        this.classList.add('was-validated');
    });
</script>
</body>
</html>