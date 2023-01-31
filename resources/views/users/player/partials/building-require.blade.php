
                        {{-- requisitos do $name --}}
                        <div class="col-12 col-xl-9 mx-auto mt-5" >
                            <div class="table-responsive" >
                                <table id="not-build" class="table table-hover table-sm align-middle mb-0" >
                                    <thead>
                                        <tr>
                                            <th>Requerimentos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ( $b = ( property_exists( $village->on, $name ) ) ? $village->on->$name : $village->off->$name )
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
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
