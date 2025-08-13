<div id="first-item" data-value="{{ $citas->firstItem() }}" style="display:none;"></div>

<table id="tabla-citas" class="table table-bordered table-hover align-middle text-center" style="table-layout: fixed; width: 100%;">
    <thead>
    <tr>
        <th style="width: 4%;">#</th>
        <th style="width: 25%;">Cliente</th>
        <th style="width: 15%;">Fecha</th>
        <th style="width: 10%;">Hora</th>
        <th style="width: 20%;">Servicio</th>
        <th style="width: 12%;">Estado</th>
        <th style="width: 14%;">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @forelse($citas as $index => $cita)
        <tr
                data-cliente="{{ strtolower($cita->cliente->nombre) }}"
                data-empleado="{{ strtolower($cita->empleado->nombre_empleado) }}"
                data-estado="{{ strtolower($cita->estado) }}"
                style="cursor: default;"
        >
            <td>{{ $citas->firstItem() + $index }}</td>

            <td style="max-width: 200px; word-wrap: break-word; white-space: normal;" title="{{ $cita->cliente->nombre }}">
                {{ $cita->cliente->nombre }}
            </td>

            <td class="text-fecha">
                {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                <small class="d-block text-muted">
                    @php
                        $diasSemana = [
                            'Monday' => 'Lunes',
                            'Tuesday' => 'Martes',
                            'Wednesday' => 'Miércoles',
                            'Thursday' => 'Jueves',
                            'Friday' => 'Viernes',
                            'Saturday' => 'Sábado',
                            'Sunday' => 'Domingo'
                        ];
                        $diaIngles = \Carbon\Carbon::parse($cita->fecha)->format('l');
                    @endphp
                    {{ $diasSemana[$diaIngles] ?? $diaIngles }}
                </small>
            </td>

            <td class="text-hora">
                <i class="fas fa-clock"></i>
                {{ \Carbon\Carbon::parse($cita->hora_inicio)->format('H:i') }}
            </td>

            <td style="max-width: 180px; word-wrap: break-word; white-space: normal;" title="{{ $cita->servicio->nombre_servicio }}">
                {{ $cita->servicio->nombre_servicio }}
            </td>

            <td>
                @switch($cita->estado)
                    @case('pendiente')
                        <span class="badge badge-pendiente">
                            <i class="fas fa-clock"></i> Pendiente
                        </span>
                        @break
                    @case('en_proceso')
                        <span class="badge badge-en-proceso">
                            <i class="fas fa-play"></i> En proceso
                        </span>
                        @break
                    @case('finalizada')
                        <span class="badge badge-finalizada">
                            <i class="fas fa-check"></i> Finalizada
                        </span>
                        @break
                    @case('cancelada')
                        <span class="badge badge-cancelada">
                            <i class="fas fa-times"></i> Cancelada
                        </span>
                        @break
                @endswitch
            </td>

            <td>
                <div class="acciones-btns">
                    <a href="{{ route('citas.show', $cita->id) }}" class="btn-ver" title="Ver detalles">
                        Ver
                    </a>
                    <a href="{{ route('citas.edit', $cita->id) }}" class="btn-editar" title="Editar cita">
                        Editar
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
    @if($citas->hasPages())
        <div class="pagination-info mb-2 text-center">
            Mostrando del {{ $citas->firstItem() }} al {{ $citas->lastItem() }} de {{ $citas->total() }} citas
        </div>

        {{ $citas->appends(request()->query())->links('pagination::bootstrap-5') }}
    @endif
</div>
