
<div class="col-12 col-xl-9 mx-auto @if ( empty( $events->first() ) ) d-none @endif " >
    <div class="table-responsive" >
        <table id="building-queue" class="table table-hover table-sm align-middle mb-0" >
            <thead>
                <tr>
                    <th>Edifício</th>
                    <th>Duração</th>
                    <th>Conclusão</th>
                    <th>Cancelamento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $events as $key => $event )
                    <tr>
                        <td class="@if ( $loop->first || $loop->last ) border-bottom-0 @endif" >
                            <div class="row mx-auto" >
                                <div class="col-12 col-lg-4 text-center ps-lg-0 m-auto" >
                                    @php
                                        $png  = Helper::getLevelImage( $event->key, $event->level );
                                        $img  = "{$event->key}{$png}.png";
                                    @endphp
                                    <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="" >
                                </div>
                                <div class="col-12 col-lg-8 text-center text-lg-start ps-lg-0 m-auto" >
                                    <p class="mb-0" >
                                        {{ $event->name }}
                                        <br>
                                        <span class="text-muted" >
                                            Nível {{ $event->level }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="@if ( $loop->first || $loop->last ) border-bottom-0 @endif" @if ( $loop->first ) id="queue-duration" @endif >
                            {{ $event->duration_f }}
                        </td>
                        <td class="@if ( $loop->first || $loop->last ) border-bottom-0 @endif" @if ( $loop->first ) id="queue-finish"   @endif >
                            {{ $event->conclusion }}
                        </td>
                        <td class="@if ( $loop->first || $loop->last ) border-bottom-0 @endif" >
                            <a class="btn btn-default fw-bold btn-outline-danger btn-sm w-100"
                                onclick="event.preventDefault(); document.getElementById( 'form-builded-{{ $key }}' ).submit();"
                                href="{{ route( "village.cancel.upgrade.building", [ "village" => $village, "event" => $event->id ] ) }}" >
                                Cancelar
                            </a>
                            <form id="form-builded-{{ $key }}" method="POST" class="d-none" action="{{ route( "village.cancel.upgrade.building", [ "village" => $village, "event" => $event->id ] ) }}" >
                                @csrf
                            </form>
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
            </tbody>
        </table>
    </div>
</div>

@section( "js_queue_build" )
    <script>
        window.onload = function() {

            let ftime      = parseInt( "{{ $events->first() ? $events->first()->total_time : 0 }}" );
            let time       = parseInt( "{{ $events->first() ? $events->first()->duration   : 0 }}" );
            let progress   = 0;
            let idInterval = null;

            if ( ftime & time )
                idInterval = setInterval( setTimeDuration, 1000 );

            function setTimeDuration()
            {
                if ( time <= 0 )
                {
                    $( "#queue-duration" ).text( "quase concluído" );
                    clearInterval( idInterval );
                    window.location.reload();
                }
                else
                {
                    time     = time - 1;
                    time     = ( time < 0 ) ? 0 : time;
                    progress = 100 - ( ( time * 100 ) / ftime );

                    $( "#queue-duration"    ).text( moment.utc( time * 1000 ).format( "HH:mm:ss" ) );
                    $( "#queue-progression" ).css( "width", `${progress}%` );
                }
            }
        };
    </script>
@endsection
