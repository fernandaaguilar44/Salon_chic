
<div id="first-item" data-value="{{ $empleados->firstItem() }}" style="display:none;"></div>

<table id="tabla-empleados" class="table table-bordered table-hover align-middle text-center" style="table-layout: fixed; width: 100%;">
    <thead>
    <tr>
        <th style="width: 5%;">#</th>
        <th style="width: 30%;">Nombre</th>
        <th style="width: 20%;">Cargo</th>
        <th style="width: 12%;">Estado</th>
        <th style="width: 18%;">Fecha de Ingreso</th>
        <th style="width: 15%;">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @forelse($empleados as $index => $empleado)
        <tr
                class="{{ strtolower(trim($empleado->estado)) !== 'activo' ? 'inactivo' : '' }}"
                data-estado="{{ strtolower($empleado->estado) }}"
                data-nombre="{{ strtolower($empleado->nombre_empleado) }}"
                data-cargo="{{ strtolower($empleado->cargo) }}"
                style="cursor: default;"
        >
            <td>{{ $empleados->firstItem() + $index }}</td>
            <td class="text-truncate" style="max-width: 250px;" title="{{ $empleado->nombre_empleado }}">
                {{ $empleado->nombre_empleado }}
            </td>
            <td class="text-truncate" title="{{ $empleado->cargo }}">{{ ucfirst($empleado->cargo) }}</td>
            <td>
                @if ($empleado->estado == 'activo')
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</td>
            <td>
                <div class="acciones-btns">
                    <a href="{{ route('empleados.show', $empleado->id) }}" class="btn-ver">Ver</a>
                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn-editar">Editar</a>
                </div>
            </td>
        </tr>
    @empty
    @endforelse

    <!-- Mensaje dinámico para filtros -->
    <tr id="fila-mensaje" style="display:none;">
        <td colspan="6" class="text-center text-muted" style="font-style: italic;"></td>
    </tr>
    </tbody>
</table>

<div class="pagination-container" id="paginacion">
    @if($empleados->hasPages())
        <div class="pagination-info mb-2 text-center">
            Mostrando del {{ $empleados->firstItem() }} al {{ $empleados->lastItem() }} de {{ $empleados->total() }} empleados
        </div>
    @endif

    {{ $empleados->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>