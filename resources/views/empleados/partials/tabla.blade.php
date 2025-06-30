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
                <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn-editar">Editar</a>
                <a href="{{ route('empleados.show', $empleado->id) }}" class="btn-ver">Ver</a>


            </td>
        </tr>
    @empty
        <!-- Mensaje dinámico para filtros -->
        <tr id="fila-mensaje" style="display:none;">
            <td colspan="6" class="text-center text-muted" style="font-style: italic;"></td>
        </tr>

    @endforelse
    </tbody>
</table>

@if ($empleados->hasPages())
    <div class="d-flex flex-column align-items-center mt-4">
        <div class="text-muted small mb-2">
            Mostrando {{ $empleados->firstItem() }} a {{ $empleados->lastItem() }} de {{ $empleados->total() }} resultados
        </div>
        <nav>
            <ul class="pagination justify-content-center m-0">
                <li class="page-item {{ $empleados->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $empleados->previousPageUrl() }}" aria-label="Anterior">Anterior</a>
                </li>
                @foreach ($empleados->getUrlRange(1, $empleados->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $empleados->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ !$empleados->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $empleados->nextPageUrl() }}" aria-label="Siguiente">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
@endif
