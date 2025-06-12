<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear nuevo empleado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #E6E6FA; /* Lavanda */
            color: white;
        }

        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            color: black;
        }

        .form-label {
            color: #E4007C; /* Rosa */
        }

        .form-control,
        .form-select {
            background-color: white;
            color: black;
        }

        .btn-primary {
            background-color: #C97BFF; /* Morado oscuro */
            border-color: #C97BFF;
            color: black;
            text-shadow: white 1px 1px;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;

        }

        .btn-secondary {
            background-color: #C97BFF; /* Morado */
            border-color: #C97BFF;
            color: black;
            font-weight: bold;
            text-shadow: white 1px 1px;
            transition: all 0.4s ease;
        }

        .btn-secondary:hover {
            background-color: #C97BFF;
            border-color: #C97BFF;
            color: white;
            text-shadow: white 1px 1px;
            transform: scale(1.2);
            opacity: 0.9;

        }

        .btn-primary:hover {
            background-color: #C97BFF;
            border-color: #C97BFF;
            color: white;
            text-shadow: black 1px 1px;
            transform: scale(1.2);
            opacity: 0.9;
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
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="form-container">
                <h2 class="mb-4 text-center" style="color: #4B0082;">Crear Nuevo Empleado</h2>


                <form  method="POST" action="{{ route('empleados.store') }}" id="empleadoForm" autocomplete="off" novalidate >
                    @csrf

                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="nombre_empleado" class="form-label">Nombre Empleado</label>
                            <input type="text" id="nombre_empleado" name="nombre_empleado"
                                   class="form-control @error('nombre_empleado') is-invalid @enderror"
                                   value="{{ old('nombre_empleado') }}" required minlength="10" maxlength="30"
                                   placeholder="Escriba nombre del empleado" onkeypress="return soloLetras(event)" />
                            <div class="invalid-feedback">
                                Ingrese el nombre y debe ser solo letras.
                            </div>
                        </div>








                        <div class="col-12 col-md-4">
                            <label for="numero_identidad" class="form-label">Número de Identidad</label>
                            <input type="text" id="numero_identidad" name="numero_identidad"
                                   class="form-control @error('numero_identidad') is-invalid @enderror"
                                   value="{{ old('numero_identidad') }}" required maxlength="13"
                                   placeholder="#############"  onkeypress="return soloNumeros(event)"/>
                            <div class="invalid-feedback">Ingrese el número de identidad debe tener exactamente 13 números.</div>
                        </div>

                        {{-- ✅ Aquí mostramos el error real validado por Laravel --}}
                        @error('numero_identidad')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="col-12 col-md-4">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" id="telefono" name="telefono"
                                   class="form-control @error('telefono') is-invalid @enderror"
                                   value="{{ old('telefono') }}" required maxlength="8"
                                   placeholder="########"  onkeypress="return soloNumeros(event)" />
                            <div class="invalid-feedback">Ingrese el número de teléfono debe tener 8 dígitos.</div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" id="direccion" name="direccion"
                                   class="form-control @error('direccion') is-invalid @enderror"
                                   value="{{ old('direccion') }}" required maxlength="100"  placeholder="Escriba la dirrecion del empleado" />
                            <div class="invalid-feedback">Ingrese la dirección es obligatoria y no debe ser muy larga.</div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="salario" class="form-label">Salario</label>
                            <input type="number" id="salario" name="salario"
                                   class="form-control @error('salario') is-invalid @enderror"
                                   min="0" step="0.01"
                                   placeholder="000000.00"
                                   oninput="limitarSalario(this)" />

                            <div class="invalid-feedback">Ingrese el salario es obligatorio y debe ser de 10000 a 20000</div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="contacto_emergencia" class="form-label">Contacto de Emergencia</label>
                            <input type="text" id="contacto_emergencia" name="contacto_emergencia"
                                   class="form-control @error('contacto_emergencia') is-invalid @enderror"
                                   value="{{ old('contacto_emergencia') }}" required maxlength="8" minlength="8"
                                   placeholder="########" />
                            <div class="invalid-feedback">Ingrese el contacto de emergencia debe tener 8 dígitos.</div>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email"
                                   name="correo"
                                   id="correo"
                                   class="form-control @error('correo') is-invalid @enderror"
                                   placeholder="ejemplo@dominio.hn"
                                   required
                                   pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(hn|com|org|edu|net)"
                                   title="Ingresa un correo válido con dominio .hn, .com, .org, .edu o .net"
                                   value="{{ old('correo') }}" />
                            @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">Debe ingresar un correo electrónico válido.</div>
                                @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="cargo" class="form-label">Cargo</label>
                            <select id="cargo" name="cargo" class="form-select @error('cargo') is-invalid @enderror" required>
                                <option value="">Seleccione un cargo</option>
                                <option value="Estilista" {{ old('cargo') == 'Estilista' ? 'selected' : '' }}>Estilista</option>
                                <option value="Manicurista" {{ old('cargo') == 'Manicurista' ? 'selected' : '' }}>Manicurista</option>
                            </select>
                            <div class="invalid-feedback">Debe seleccionar un cargo válido.</div>
                        </div>




                        <div class="col-12 col-md-4">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" id="fecha_ingreso" name="fecha_ingreso"
                                   class="form-control @error('fecha_ingreso') is-invalid @enderror"
                                   value="{{ old('fecha_ingreso') }}" required max="{{ date('Y-m-d') }}" />
                            <div class="invalid-feedback">La fecha de ingreso es obligatoria y no puede ser futura.</div>
                        </div>


                        <input type="hidden" name="estado" value="activo">

                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="reset" class="btn btn-secondary">Limpiar</button>
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function soloLetras(e) {
        let key = e.keyCode || e.which;
        let tecla = String.fromCharCode(key).toLowerCase();
        let letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        let especiales = [8, 37, 39, 46]; // backspace, flechas, suprimir

        let input = e.target;

        // No permitir punto ni comilla simple ni caracteres no permitidos
        if (tecla === '.' || tecla === "'" || (letras.indexOf(tecla) === -1 && !especiales.includes(key))) {
            e.preventDefault();
            return false;
        }

        // No permitir espacio como primer carácter
        if (key === 32 && input.selectionStart === 0) {
            e.preventDefault();
            return false;
        }

        // No permitir múltiples espacios consecutivos
        if (key === 32) {
            const valor = input.value;
            const pos = input.selectionStart;
            if (valor.charAt(pos - 1) === ' ') {
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
        const permitidos = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Delete'];
        if (/\d/.test(e.key) || permitidos.includes(e.key)) {
            return true;
        }
        e.preventDefault(); // evita que se escriba otro carácter
        return false;
    }

    function validarNumeroSinCeroInicio(e) {
        let key = e.keyCode || e.which;

        // Permitir teclas especiales
        if ([8, 37, 39, 46].includes(key)) return true;

        let input = e.target;
        let char = String.fromCharCode(key);

        // No permitir espacio
        if (key === 32) {
            e.preventDefault();
            return false;
        }

        // Primer carácter debe ser 1-9
        if (input.value.length === 0 && !/[1-9]/.test(char)) {
            e.preventDefault();
            return false;
        }

        // Los siguientes pueden ser dígitos
        if (input.value.length > 0 && !/[0-9]/.test(char)) {
            e.preventDefault();
            return false;
        }

        return true;
    }

    // Validar número de identidad con códigos válidos de Honduras
    function validarNumeroIdentidad(value) {
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

        if (!/^\d{13}$/.test(value)) return false; // 13 dígitos numéricos exactos
        if (/^0+$/.test(value)) return false;      // No todo ceros
        if (!codigosValidos.includes(value.substring(0, 4))) return false; // Código válido

        return true;
    }

    // Validar teléfono o contacto emergencia (8 dígitos, empieza con 2,3,7,8 o 9)
    function validarTelefono(value) {
        return /^[23789]\d{7}$/.test(value.trim());
    }

    // Validar correo electrónico básico y sin espacios ni doble punto
    function validarCorreo(value) {
        const emailRegex = /^[a-zA-Z](?!.*\.\.)[a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(value.trim()) && !/\s/.test(value);
    }

    document.getElementById('empleadoForm').addEventListener('submit', function(event) {
        const form = event.target;
        let valido = true;

        // Limpiar estados previos
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        // Validar nombre_empleado
        const nombre = form.nombre_empleado.value.trim();
        const letrasNombre = nombre.replace(/\s+/g, '');
        if (!nombre || nombre.length > 25 || letrasNombre.length < 3 || !/^[a-záéíóúñÁÉÍÓÚ\s]+$/i.test(nombre)) {
            form.nombre_empleado.classList.add('is-invalid');
            valido = false;
        }

        // Validar número de identidad
        if (!validarNumeroIdentidad(form.numero_identidad.value)) {
            form.numero_identidad.classList.add('is-invalid');
            valido = false;
        }

        // Validar teléfono
        if (!validarTelefono(form.telefono.value)) {
            form.telefono.classList.add('is-invalid');
            valido = false;
        }

        // Validar dirección
        const direccion = form.direccion.value.trim();
        if (!direccion || direccion.length > 100) {
            form.direccion.classList.add('is-invalid');
            valido = false;
        }

        // Validar salario
        const salario = parseFloat(form.salario.value.trim());
        const salarioMinimo = 10000;
        const salarioMaximo = 20000;
        form.salario.classList.remove('is-invalid');
        if (isNaN(salario) || salario < salarioMinimo || salario > salarioMaximo || /^0+(\.0+)?$/.test(form.salario.value.trim())) {
            form.salario.classList.add('is-invalid');
            valido = false;
        }

        // Validar contacto_emergencia
        if (!validarTelefono(form.contacto_emergencia.value)) {
            form.contacto_emergencia.classList.add('is-invalid');
            valido = false;
        }

        // Validar correo electrónico
        if (!validarCorreo(form.correo.value)) {
            form.correo.classList.add('is-invalid');
            valido = false;
        }


        // Validar cargo (mínimo 3 caracteres)
        const cargo = form.cargo.value.trim();
        if (cargo.length < 3) {
            form.cargo.classList.add('is-invalid');
            valido = false;
        }

        // Validar fecha_ingreso (fecha válida)
        if (!form.fecha_ingreso.value) {
            form.fecha_ingreso.classList.add('is-invalid');
            valido = false;
        }


        if (!valido) {
            event.preventDefault();
            event.stopPropagation();
        }
    });
</script>

