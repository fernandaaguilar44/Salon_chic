<div id="first-item" data-value="{{ $clientes->firstItem() }}" style="display:none;"></div>

<table id="tabla-clientes" class="table table-bordered table-hover align-middle text-center" style="table-layout: fixed; width: 100%;">
    <thead>
    <tr>
        <th style="width: 4%;">#</th>
        <th style="width: 22%;">Nombre</th>
        <th style="width: 12%;">Teléfono</th>
        <th style="width: 25%;">Correo</th>
        <th style="width: 10%;">Sexo</th>
        <th style="width: 15%;">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @forelse($clientes as $index => $cliente)
        <tr
                data-nombre="{{ strtolower($cliente->nombre) }}"
                data-telefono="{{ $cliente->telefono }}"
                data-sexo="{{ strtolower($cliente->sexo) }}"
                style="cursor: default;"
        >
            <td>{{ $clientes->firstItem() + $index }}</td>
            <td style="max-width: 180px; word-wrap: break-word; white-space: normal;" title="{{ $cliente->nombre }}">
                {{ $cliente->nombre }}
            </td>

            <td>{{ $cliente->telefono }}</td>
            <td style="max-width: 220px; word-wrap: break-word; white-space: normal;" title="{{ $cliente->correo }}">
                {{ $cliente->correo }}
            </td>

            <td>{{ ucfirst($cliente->sexo) }}</td>
            <td>
                <div class="acciones-btns">
                    <a href="{{ route('clientes.show', $cliente->id) }}" class="btn-ver">Ver</a>
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-editar">Editar</a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted"></td>
        </tr>
    @endforelse

    <!-- Fila dinámica para mostrar mensaje al filtrar -->
    <tr id="fila-mensaje" style="display:none;">
        <td colspan="6" class="text-center text-muted" style="font-style: italic;"></td>
    </tr>
    </tbody>
</table>

<div class="pagination-container">
    @if($clientes->hasPages())
        <div class="pagination-info mb-2 text-center">
            Mostrando del {{ $clientes->firstItem() }} al {{ $clientes->lastItem() }} de {{ $clientes->total() }} clientes
        </div>
    @endif

    {{ $clientes->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
