
                        {{-- requisitos do $name --}}
                        <div class="col-12 col-xl-9 mx-auto mt-5" >

                            @php
                                $b     = ( property_exists( $village->buildings->on, $name ) ) ? $village->buildings->on->$name : $village->buildings->off->$name;
                                $pngR  = Helper::getLevelImage( $village->buildings->on->main->key, $village->buildings->on->main->level );
                                $imgR  = "{$village->buildings->on->main->key}{$pngR}.png";
                                $ready = [];
                            @endphp

                            @if ( empty( $b->required ) )
                                <div class="py-2 text-center" >
                                    <a class="btn btn-link" href="{{ route( "village.main", [ "village" => $village ] ) }}" >
                                        <img src="{{ asset( "assets/graphic/buildings/{$imgR}" ) }}" alt="{{ $b->name }}" >
                                        <br>
                                        Construir {{ $b->name }}
                                    </a>
                                </div>
                            @else
                                <div class="table-responsive" >
                                    <table id="not-build" class="table table-hover table-sm align-middle mb-0" >
                                        <thead>
                                            <tr>
                                                <th>Requerimentos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $b->required as $key => $level )
                                                <tr>
                                                    <td class="@if ( $loop->last ) border-bottom-0 @endif" >
                                                        @php
                                                            $disabled = ( $village->{ "building_{$key}" } < $level ) ? "disabled" : "";
                                                            $png      = Helper::getLevelImage( $key, $level );
                                                            $img      = "{$key}{$png}.png";
                                                            $ready[]  = empty( $disabled ) ? true : false;
                                                        @endphp
                                                        <button class="btn btn-link btn-sm m-auto text-decoration-none text-dark cursor-none {{ $disabled }}" >
                                                            <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="{{ $buildings[ $key ][ "name" ] }}" >
                                                            {{ $buildings[ $key ][ "name" ] }} - Nível {{ $level }}
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if ( !in_array( false, $ready ) )
                                    <div class="py-2 text-center" >
                                        <a class="btn btn-link text-decoration-none" href="{{ route( "village.main", [ "village" => $village ] ) }}" >
                                            <img src="{{ asset( "assets/graphic/buildings/{$imgR}" ) }}" alt="{{ $b->name }}" >
                                            <br>
                                            Construir {{ $b->name }}
                                        </a>
                                    </div>
                                @endif
                            @endif
                        </div>
