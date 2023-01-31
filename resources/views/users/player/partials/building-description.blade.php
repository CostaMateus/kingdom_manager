
                        <div class="row" >
                            @php
                                $key   = $building[ "key" ];
                                $key2  = "building_{$key}";
                                $level = ( $village->$key2 != 0 ) ? "Nível {$village->$key2}" : "não construído";
                                $png   = Helper::getLevelImage( $key, $village->$key2 );
                                $img   = "{$key}{$png}.png";
                            @endphp
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 text-center my-auto" >
                                <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="{{ $building[ "name" ] }}" >
                            </div>
                            <div class="col-12 col-sm-8 col-md-9 col-lg-10 mt-3 mt-sm-0" >
                                <p class="h3 mb-2" >
                                    <b>{{ $building[ "name" ] }} ({{ $level }})</b>
                                </p>
                                <p class="h5 mb-0" >
                                    {{ $building[ "description" ] }}
                                </p>
                                <button class="fs-6 btn btn-link px-0" type="button" data-bs-toggle="modal" data-bs-target="#modal_{{ $building[ "key" ] }}" >
                                    Mais informações
                                </button>
                            </div>
                        </div>

                        <div class="modal fade" id="modal_{{ $building[ "key" ] }}" tabindex="-1" aria-labelledby="modal_{{ $building[ "key" ] }}_label" aria-hidden="true" >
                            <div class="modal-dialog" >
                                <div class="modal-content" >
                                    <div class="modal-header" >
                                        <h1 class="modal-title fs-5" id="modal_{{ $building[ "key" ] }}_label" >{{ $building[ "name" ] }}</h1>
                                        <button type="button" class="btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                                    </div>
                                    <div class="modal-body" >

                                        <div class="table-responsive" >
                                            <table class="table table-hover table-sm align-middle mb-0" >
                                                <thead>
                                                    <tr class="text-center" >
                                                        <th class="w-25" ></th>
                                                        <th              >{{ $title }}</th>
                                                        <th              >Pontos ganhos por nível</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $maxLevel   = $building[ "max_level"       ];

                                                        $base       = $building[ $field            ];
                                                        $rate       = $building[ "{$field}_factor" ];

                                                        $pointsBase = $building[ "points"          ];
                                                        $pointsRate = $building[ "points_factor"   ];
                                                    @endphp
                                                    @foreach ( range( 1, $maxLevel ) as $i )
                                                        @php
                                                            $print       = ( $field == "time" ) ? $base : $base * config( "game.speed" );
                                                            $base2       = $base;
                                                            $pointsBase2 = $pointsBase;

                                                            if ( $i > 1 )
                                                            {
                                                                if ( $field == "time" )
                                                                {
                                                                    $cal   = $base * $rate;
                                                                    $base  = $base + round( $cal, 0, PHP_ROUND_HALF_DOWN );
                                                                    $base2 = ( $cal - $base ) * -1;

                                                                    $print = $base2;
                                                                }
                                                                else
                                                                {
                                                                    $cal   = $base * $rate;
                                                                    $base  = $cal;
                                                                    $base2 = $cal;

                                                                    $print = $base2 * config( "game.speed" );
                                                                }

                                                                $cal         = $pointsBase * $pointsRate;
                                                                $pointsBase2 = $cal - $pointsBase;
                                                                $pointsBase  = $cal;
                                                            }

                                                            $key = $building[ "key" ];
                                                        @endphp
                                                        <tr class="text-center @if ( $i == $village->{"building_{$key}"} ) table-active @endif" >
                                                            <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                                Nível {{ $i }}
                                                            </td>
                                                            <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                                {{ ( int ) ( $print ) }}{{ $uni }}
                                                            </td>
                                                            <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                                {{ ( int ) ( $pointsBase2 ) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
