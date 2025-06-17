


<table class="table table-bordered table-hover align-middle text-center">
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Cargo</th>
        <th>Estado</th>
        <th>Fecha de Ingreso</th>
        <th>Acciones</th>

    </tr>
    </thead>

    <tbody>
    @forelse($empleados as $index => $empleado)
        <tr class="{{ strtolower(trim($empleado->estado)) === 'inactivo' ? 'inactivo' : '' }}">
            <td>{{ $empleados->firstItem() + $index }}</td>
            <td>{{ $empleado->nombre_empleado }}</td>
            <td>{{ $empleado->cargo }}</td>
            <td>{{ ucfirst($empleado->estado) }}</td>
            <td>{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</td>
            <td class="acciones-btns">
                <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-sm btn-primary" title="Editar">Editar</a>

                <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-sm btn-info" title="Ver detalles">Ver</a>
            </td>
        </tr>
    @empty
        <tr><td colspan="6">No se encontraron empleados.</td></tr>
    @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $empleados->links() }}
</div>
