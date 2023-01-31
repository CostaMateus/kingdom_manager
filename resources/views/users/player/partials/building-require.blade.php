
                        {{-- requisitos do $name --}}
                        <div class="col-12 col-xl-9 mx-auto mt-5" >

                            @php
                                $b = ( property_exists( $village->on, $name ) ) ? $village->on->$name : $village->off->$name;
                            @endphp

                            @if ( empty( $b->required ) )
                                @php
                                    $png = Helper::getLevelImage( $village->on->main->key, $village->on->main->level );
                                    $img = "{$village->on->main->key}{$png}.png";
                                @endphp
                                <div class="py-2 text-center" >
                                    <a class="btn btn-link" href="{{ route( "village.main", [ "village" => $village ] ) }}" >
                                        <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="{{ $b->name }}" >
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
                                                        @endphp
                                                        <button class="btn btn-link btn-sm m-auto text-decoration-none text-dark cursor-none {{ $disabled }}" >
                                                            <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="{{ $b->name }}" >
                                                            {{ $b->name }} - Nível {{ $level }}
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            @endif
                        </div>
