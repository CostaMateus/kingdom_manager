

    <div class="col-12 col-sm-8 col-md-6 col-lg-5 mx-auto mt-5" >
        <div class="table-responsive" >
            <table class="table table-hover table-sm align-middle mb-0" >
                <thead>
                    <tr class="text-center" >
                        <th></th>
                        <th>{{ $title }}</th>
                        <th>Pontos ganhos por nível</th>
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
                            $base2       = $base;
                            $pointsBase2 = $pointsBase;

                            if ( $i > 1 )
                            {
                                $cal   = $base * $rate;
                                $base  = $cal;
                                $base2 = $cal;

                                $cal         = $pointsBase * $pointsRate;
                                $pointsBase2 = $cal - $pointsBase;
                                $pointsBase  = $cal;
                            }
                        @endphp
                        <tr class="text-center @if ($i == $village->building_wood) table-active @endif" >
                            <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                Nível {{ $i }}
                            </td>
                            <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                {{ ( int ) ( $base2 * config( "game.speed" ) ) }}{{ $uni }}
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
