<div id="first-item" data-value="{{ $promociones->firstItem() }}" style="display:none;"></div>

<table id="tabla-promociones" class="table table-bordered table-hover align-middle text-center" style="table-layout: fixed; width: 100%;">
    <thead>
    <tr>
        <th style="width: 3%;">#</th>
        <th style="width: 23%;">Nombre</th>
        <th style="width: 12%;">Tipo</th>
        <th style="width: 9%;">Valor</th>
        <th style="width: 11%;">Vigencia</th>
        <th style="width: 8%;">Estado</th>
        <th style="width: 6%;">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @forelse($promociones as $index => $promocion)
        @php
            $esExpirado = $promocion->fecha_expiracion < now();
        @endphp
        <tr
                data-nombre="{{ strtolower($promocion->nombre) }}"
                data-tipo="{{ strtolower($promocion->tipo) }}"
                data-estado="{{ $esExpirado ? 'expirado' : strtolower($promocion->estado) }}"
                style="cursor: default;"
        >
            <td>{{ $promociones->firstItem() + $index }}</td>

            <td style="max-width: 200px; word-wrap: break-word; white-space: normal;" title="{{ $promocion->nombre }}">
                <strong>{{ $promocion->nombre }}</strong>
            </td>

            <td>
                @switch($promocion->tipo)
                    @case('porcentaje')
                        <span class="badge badge-porcentaje">
                            <i class="fas fa-percentage"></i> Porcentaje
                        </span>
                        @break
                    @case('monto_fijo')
                        <span class="badge badge-monto-fijo">
                            <i class="fas fa-dollar-sign"></i> Monto fijo
                        </span>
                        @break
                    @case('combo')
                        <span class="badge badge-combo">
                            <i class="fas fa-gift"></i> Combo
                        </span>
                        @break
                @endswitch
            </td>

            <td>
                @if($promocion->tipo == 'porcentaje')
                    {{ $promocion->valor }}%
                @else
                    L. {{ number_format($promocion->valor, 0, '.', ',') }}
                @endif
            </td>

            <td class="text-fecha">
                <div>
                    {{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y') }}
                </div>
                <small class="d-block text-muted">
                    {{ \Carbon\Carbon::parse($promocion->fecha_expiracion)->format('d/m/Y') }}
                </small>
            </td>

            <td>

                @if($promocion->estado === 'activo')
                    <span class="badge badge-activo">
                        <i class="fas fa-check-circle"></i> Activo
                    </span>
                @else
                    <span class="badge badge-inactivo">
                        <i class="fas fa-times-circle"></i> Inactivo
                    </span>
                @endif
            </td>

            <td>
                <div class="acciones-btns">
                    <a href="{{ route('promociones.show', $promocion->id) }}" class="btn-ver" title="Ver detalles">
                        Ver
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center text-muted py-4">

            </td>
        </tr>
    @endforelse

    <!-- Fila dinámica para mostrar mensaje al filtrar -->
    <tr id="fila-mensaje" style="display:none;">
        <td colspan="7" class="text-center text-muted" style="font-style: italic;"></td>
    </tr>
    </tbody>
</table>

<div class="pagination-container" id="paginacion">
    @if($promociones->hasPages())
        <div class="pagination-info mb-2 text-center">
            Mostrando del {{ $promociones->firstItem() }} al {{ $promociones->lastItem() }} de {{ $promociones->total() }} promociones
        </div>

        {{ $promociones->appends(request()->query())->links('pagination::bootstrap-5') }}
    @endif
</div>