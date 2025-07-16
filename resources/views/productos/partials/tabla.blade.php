<!-- tabla.blade.php o el archivo que incluyas en #tabla-container -->
<div id="first-item" data-value="{{ $productos->firstItem() }}" style="display:none;"></div>

<table id="tabla-productos" class="table table-bordered table-hover align-middle text-center" style="table-layout: fixed; width: 100%;">
    <thead>
    <tr>
        <th style="width: 1%;">#</th>
        <th style="width: 12%;">Imagen</th>
        <th style="width: 15%;">Nombre</th>
        <th style="width: 10%;">Código</th>
        <th style="width: 10%;">Categoría</th>
        <th style="width: 15%;">Acciones</th>
    </tr>
    </thead>

    <tbody>
    @forelse($productos as $index => $producto)
        <tr
            data-nombre="{{ strtolower($producto->nombre) }}"
            data-categoria="{{ strtolower($producto->categoria) }}"
            style="cursor: default;"
        >
            <td>{{ $productos->firstItem() + $index }}</td>
            <td class="text-truncate" title="{{ $producto->codigo}}">{{ $producto->codigo }}</td>
            <td class="text-truncate" style="max-width: 300px;" title="{{ $producto->nombre}}">
                {{ $producto->nombre }}
            </td>
            <td>{{ ucfirst($producto->categoria) }}</td>
            <td>
                <div class="acciones-btns">
                    <a href="{{ route('productos.show', $producto->id) }}" class="btn-ver">Ver</a>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn-editar">Editar</a>
                </div>
            </td>
        </tr>
    @empty
    @endforelse

    <!-- Mensaje dinámico para filtros -->
    <tr id="fila-mensaje" style="display:none;">
        <td colspan="8" class="text-center text-muted" style="font-style: italic;"></td>
    </tr>
    </tbody>
</table>

<div class="pagination-container">
    @if($productos->hasPages())
        <div class="pagination-info mb-2 text-center">
            Mostrando del {{ $productos->firstItem() }} al {{ $productos->lastItem() }} de {{ $productos->total() }} productos
        </div>
    @endif

    {{ $productos->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
