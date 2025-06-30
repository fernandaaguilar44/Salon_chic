<!-- tabla.blade.php o el archivo que incluyas en #tabla-container -->
<div id="first-item" data-value="{{ $servicios->firstItem() }}" style="display:none;"></div>

<table id="tabla-servicios" class="table table-bordered table-hover align-middle text-center" style="table-layout: fixed; width: 100%;">
    <thead>
    <tr>
        <th style="width: 5%;">#</th>
        <th style="width: 22%;">Nombre</th>
        <th style="width: 15%;">Categoría</th>
        <th style="width: 10%;">Precio</th>
        <th style="width: 12%;">Estado</th>
        <th style="width: 14%;">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @forelse($servicios as $index => $servicio)
        <tr
                class="{{ strtolower(trim($servicio->estado)) !== 'activo' ? 'inactivo' : '' }}"
                data-estado="{{ strtolower($servicio->estado) }}"
                data-nombre="{{ strtolower($servicio->nombre_servicio) }}"
                data-categoria="{{ strtolower($servicio->categoria_servicio) }}"
                style="cursor: default;"
        >
            <td>{{ $servicios->firstItem() + $index }}</td>
            <td class="text-truncate" title="{{ $servicio->nombre_servicio }}">{{ $servicio->nombre_servicio }}</td>
            <td>{{ ucfirst($servicio->categoria_servicio) }}</td>
            <td>L {{ number_format($servicio->precio_base, 2) }}</td>
            <td>
                @if ($servicio->estado == 'activo')
                    <span class="badge bg-success">Activo</span>
                @elseif ($servicio->estado == 'inactivo')
                    <span class="badge bg-secondary">Inactivo</span>
                @elseif ($servicio->estado == 'temporalmente_suspendido')
                    <span class="badge badge-suspendido">Suspendido temporalmente</span>
                @else
                    <span class="badge bg-light text-dark">Estado desconocido</span>
                @endif
            </td>


            <td>
                <div class="acciones-btns">
                    <a href="{{ route('servicios.show', $servicio->id) }}" class="btn-ver">Ver</a>
                    <a href="{{ route('servicios.edit', $servicio->id) }}" class="btn-editar">Editar</a>
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


<!-- Paginación -->
    <div class="pagination-container">
        {{ $servicios->appends(request()->query())->links('pagination::bootstrap-5') }}

        <!-- Información de paginación personalizada en español -->
        @if($servicios->hasPages())
            <div class="pagination-info">
                Mostrando del {{ $servicios->firstItem() }} al {{ $servicios->lastItem() }} de {{ $servicios->total() }} servicios
            </div>
        @endif
    </div>
</div>
