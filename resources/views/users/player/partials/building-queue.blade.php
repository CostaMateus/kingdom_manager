
<div class="col-12 col-xl-9 mx-auto" >
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
                @foreach ( range(0,0) as $key => $valeu )
                    <tr>
                        <td                                class="@if ( $loop->first || $loop->last ) border-bottom-0 @endif" >
                            <div class="row mx-auto" >
                                <div class="col-12 col-lg-4 text-center ps-lg-0 m-auto" >
                                    @php
                                        // $png  = Helper::getLevelImage( $key, $building->level );
                                        // $img  = "{$key}{$png}.png";
                                    @endphp
                                    <img src="{{ asset( "assets/graphic/buildings/barracks1.png" ) }}" alt="" >
                                </div>
                                <div class="col-12 col-lg-8 text-center text-lg-start ps-lg-0 m-auto" >
                                    <p class="mb-0" >
                                        Quartel
                                        <br>
                                        <span class="text-muted" >
                                            Nível 1
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td id="{{ $key }}-queue-duration" class="@if ( $loop->first || $loop->last ) border-bottom-0 @endif" >
                            00:00:00{{-- {{ Helper::formatBuildTime( ( int ) 981 ) }} --}}
                        </td>
                        <td id="{{ $key }}-queue-finish"   class="@if ( $loop->first || $loop->last ) border-bottom-0 @endif" ></td>
                        <td                                class="@if ( $loop->first || $loop->last ) border-bottom-0 @endif" >
                            <a class="btn btn-default fw-bold btn-outline-danger btn-sm w-100"
                                onclick="event.preventDefault(); document.getElementById( 'form-{{ $key }}' ).submit();"
                                href="{{ route( "village.upgrade.building", [ "village" => $village, "building" => $key ] ) }}" >
                                Cancelar
                            </a>
                            <form id="form-{{ $key }}" method="POST" class="d-none" action="{{ route( "village.upgrade.building", [ "village" => $village, "building" => $key ] ) }}" >
                                @csrf
                            </form>
                        </td>
                    </tr>

                    @if ( $loop->first )
                        <tr>
                            <td colspan="4" class="@if ( $loop->last ) border-bottom-0 @endif" >
                                <div class="progress" role="progressbar" style="height: 5px" aria-valuemin="0" aria-valuenow="00" aria-valuemax="100" >
                                    <div id="{{ $key }}-queue-progression" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@section( "js" )

    <script>
        window.onload = function() {

            let ftime = 981;
            let time  = 981;

            let now   = Date.now();
            let mili  = ftime * 1000;

            let newTime = moment( mili + now )
            let timeFormat = newTime.format( "HH:mm:ss" );
            let dateFormat = newTime.format( "DD/MM" );

            let compare    = newTime.isSame( moment(), "day" );
            let conclusion = null;

            if ( newTime.isSame( moment(), "day" ) )
                conclusion = `Hoje às ${timeFormat}`;
            else if ( newTime.isSame( moment().add( 1, "d" ), "day" ) )
                conclusion = `Amanhã às ${timeFormat}`;
            else
                conclusion = `${dateFormat} às ${timeFormat}`;

            $( "#0-queue-finish" ).text( conclusion );

            let idInterval = setInterval( setTimeDuration, 1000 );

            function setTimeDuration()
            {
                if ( time <= 0 )
                {
                    $( "#0-queue-duration" ).text( "quase concluído" );
                    clearInterval( idInterval );
                }
                else
                {
                    time  = time - 100;

                    if ( time < 0 ) time = 0;

                    let y = 100 - ( ( time * 100 ) / ftime );

                    $( "#0-queue-duration"    ).text( moment.utc( time * 1000 ).format( "HH:mm:ss" ) );
                    $( "#0-queue-progression" ).css( "width", `${y}%` );
                }
            }
        };
    </script>
@endsection
