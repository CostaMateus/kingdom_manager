
<div class="col-12 col-xl-10 mx-auto @if ( empty( $events->first() ) ) d-none @endif " >
    <div class="table-responsive" >
        <table id="building-queue" class="table table-hover table-sm align-middle mb-0" >
            <thead>
                <tr>
                    <th class="text-center"                        >Edifício</th>
                    <th class="d-none d-sm-table-cell text-center" >Duração</th>
                    <th class="d-none d-sm-table-cell"             >Conclusão</th>
                    <th class="d-none d-sm-table-cell text-center" >Cancelamento</th>

                    <th class="d-sm-none text-center"              >Detalhes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $events as $key => $event )
                    <tr>
                        <td class="@if ( $loop->first || $loop->last ) border-bottom-0 @endif" >
                            <div class="row mx-auto" >
                                <div class="col-12 col-lg-4 text-center ps-lg-0 m-auto" >
                                    @php
                                        $png = Helper::getLevelImage( $event->key, $event->level );
                                        $img = "{$event->key}{$png}.png";
                                    @endphp
                                    <img class="w-100" src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="" >
                                </div>
                                <div class="col-12 col-lg-8 text-center text-lg-start ps-lg-0 m-auto" >
                                    <p class="mb-0" >
                                        {{ $event->name }}<br><span class="text-muted" >Nível {{ $event->level }}</span>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="d-none d-sm-table-cell text-center @if ( $loop->first || $loop->last ) border-bottom-0 @endif" @if ( $loop->first ) id="queue-duration" @endif >
                            {{ $event->duration_f }}
                        </td>
                        <td class="d-none d-sm-table-cell             @if ( $loop->first || $loop->last ) border-bottom-0 @endif" @if ( $loop->first ) id="queue-finish"   @endif >
                            {{ $event->conclusion }}
                        </td>
                        <td class="d-none d-sm-table-cell text-center @if ( $loop->first || $loop->last ) border-bottom-0 @endif" >
                            <a class="btn btn-default fw-bold btn-outline-danger btn-sm w-100" onclick="event.preventDefault(); document.getElementById( 'form-builded-{{ $key }}' ).submit();"
                                href="{{ route( "village.cancel.upgrade.building", [ "village" => $village, "event" => $event->id ] ) }}" >
                                Cancelar
                            </a>
                            <form id="form-builded-{{ $key }}" method="POST" class="d-none" action="{{ route( "village.cancel.upgrade.building", [ "village" => $village, "event" => $event->id ] ) }}" >@csrf</form>
                        </td>

                        <td class="d-sm-none @if ( $loop->first || $loop->last ) border-bottom-0 @endif" >
                            <p class="mb-0" >
                                <strong>Duração</strong>: <span id="queue-duration-2" >{{ $event->duration_f }}</span>
                            </p>
                            <p class="mb-3" >
                                <strong>Conclusão</strong>: {{ $event->conclusion }}
                            </p>
                            <a class="btn btn-default fw-bold btn-outline-danger btn-sm w-100" onclick="event.preventDefault(); document.getElementById( 'form-builded-{{ $key }}' ).submit();"
                                href="{{ route( "village.cancel.upgrade.building", [ "village" => $village, "event" => $event->id ] ) }}" >
                                Cancelar
                            </a>
                            <form id="form-builded-{{ $key }}" method="POST" class="d-none" action="{{ route( "village.cancel.upgrade.building", [ "village" => $village, "event" => $event->id ] ) }}" >@csrf</form>
                        </td>
                    </tr>

                    @if ( $loop->first )
                        <tr>
                            <td colspan="4" class="@if ( $loop->last ) border-bottom-0 @endif" >
                                <div class="progress" role="progressbar" style="height: 5px" aria-valuemin="0" aria-valuenow="00" aria-valuemax="100" >
                                    <div id="queue-progression" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach

                @if ( $events->count() >= 5 )
                    @php
                        $over  = $events->count() - 4;
                        $over *= 25;
                    @endphp
                    <tr>
                        <td colspan="5" class="text-center border-bottom-0 border-top border-dark" >
                            <p class="mb-0 h5" >
                                Custo adicional para próxima ordem a ser colocada na fila de construção: <strong>{{ $over }}%</strong>
                            </p>
                            <p class="mb-0" >
                                Custos adicionais gerados por novas ordens de construção não serão restituídos em caso de cancelamento.
                            </p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@section( "js_queue_build" )
    <script>
        document.addEventListener( "DOMContentLoaded", function() {
            let ftime      = parseInt( "{{ $events->first() ? $events->first()->total_time : 0 }}" );
            let time       = parseInt( "{{ $events->first() ? $events->first()->duration   : 0 }}" );
            let progress   = 0;
            let idInterval = null;

            if ( ftime & time ) idInterval = setInterval( setTimeDuration, 1000 );

            function setTimeDuration()
            {
                if ( time <= 0 )
                {
                    $( "#queue-duration"   ).text( "quase concluído" );
                    $( "#queue-duration-2" ).text( "quase concluído" );
                    clearInterval( idInterval );
                    window.location.href = '{{ Request::url() }}';
                }
                else
                {
                    time     = time - 1;
                    time     = ( time < 0 ) ? 0 : time;
                    progress = 100 - ( ( time * 100 ) / ftime );

                    $( "#queue-duration"    ).text( moment.utc( time * 1000 ).format( "HH:mm:ss" ) );
                    $( "#queue-duration-2"  ).text( moment.utc( time * 1000 ).format( "HH:mm:ss" ) );
                    $( "#queue-progression" ).css( "width", `${progress}%` );
                }
            }
        } );
    </script>
@endsection
