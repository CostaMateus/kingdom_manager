@if( !empty( $village->buildings->off ) )
    <div class="col-12 col-xl-10 mx-auto mt-5" >
        <div class="table-responsive" >
            <table id="not-build" class="table table-hover table-sm align-middle mb-0" >
                <thead>
                    <tr>
                        <th>Ainda não disponível</th>
                        <th>Requerimentos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $village->buildings->off as $key => $building )
                        <tr>
                            <td class="@if ( $loop->last ) border-bottom-0 @endif" >
                                <div class="row mx-auto" >
                                    <div class="col-12 col-lg-5 text-center ps-lg-0 m-auto" >
                                        <img src="{{ asset( "assets/graphic/buildings/{$key}1.png" ) }}" alt="{{ $building->name }}" >
                                    </div>
                                    <div class="col-12 col-lg-7 text-center text-lg-start ps-lg-0 m-auto" >
                                        <p class="mb-0" >
                                            {{ $building->name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="@if ( $loop->last ) border-bottom-0 @endif" >
                                @foreach ( $building->required as $key2 => $level )
                                    @php
                                        $disabled = ( property_exists( $village->buildings->on, $key2 ) ) ? ( ( $village->buildings->on->$key2->level < $level ) ? "disabled" : "" ) : "disabled";
                                        $png      = Helper::getLevelImage( $key2, $level );
                                        $img      = "{$key2}{$png}.png";
                                    @endphp
                                    <button class="btn btn-link btn-sm m-auto text-decoration-none text-dark cursor-none {{ $disabled }}" >
                                        <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="{{ $buildings[ $key2 ][ "name" ] }}" >
                                        {{ $buildings[ $key2 ][ "name" ] }} - Nível {{ $level }}
                                    </button>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
