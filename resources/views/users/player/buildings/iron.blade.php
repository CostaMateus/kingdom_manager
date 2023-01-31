@extends( "layouts.game" )

@section( "title", $buildings[ "iron" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "iron" ] ] )

                        <div class="row mt-4" >

                            @if ( $village->building_iron > 0 )
                                {{-- producao --}}
                                <div class="col-12 col-xl-9 mx-auto" >
                                    <div class="table-responsive" >
                                        <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Produção</th>
                                                    <th class="text-center" >Nível atual (por hora)</th>
                                                    @if ( $village->building_iron != $buildings[ "iron" ][ "max_level" ] )
                                                        <th class="text-center" >Próximo nível</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                        Produção atual
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ ( int ) ( $village->prod_iron * config( "game.speed" ) ) }}
                                                    </td>
                                                    @if ( $village->building_iron != $buildings[ "iron" ][ "max_level" ] )
                                                        <td class="border-bottom-0 text-center" >
                                                            {{ ( int ) ( $village->prod_iron * config( "game.speed" ) * $buildings[ "iron" ][ "iron_factor" ] ) }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-8 col-md-6 col-lg-5 mx-auto mt-5" >
                                    <div class="table-responsive" >
                                        <table class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr class="text-center" >
                                                    <th></th>
                                                    <th>Produção por nível</th>
                                                    <th>Pontos ganhos por nível</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $ironMax    = $buildings[ "iron" ][ "max_level"         ];

                                                    $prodBase   = $buildings[ "iron" ][ "production"        ];
                                                    $prodRate   = $buildings[ "iron" ][ "production_factor" ];

                                                    $pointsBase = $buildings[ "iron" ][ "points"            ];
                                                    $pointsRate = $buildings[ "iron" ][ "points_factor"     ];
                                                @endphp
                                                @foreach ( range( 1, $ironMax ) as $i )
                                                    @php
                                                        $prodBase2   = $prodBase;
                                                        $pointsBase2 = $pointsBase;

                                                        if ( $i > 1 )
                                                        {
                                                            $cal         = $prodBase * $prodRate;
                                                            $prodBase    = $cal;
                                                            $prodBase2   = $cal;

                                                            $cal         = $pointsBase * $pointsRate;
                                                            $pointsBase2 = $cal - $pointsBase;
                                                            $pointsBase  = $cal;
                                                        }
                                                    @endphp
                                                    <tr class="text-center @if ($i == $village->building_iron) table-active @endif" >
                                                        <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                            Nível {{ $i }}
                                                        </td>
                                                        <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                            {{ ( int ) ( $prodBase2 * config( "game.speed" ) ) }}/h
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
                            @else
                                @if ( !empty( $buildings[ "iron" ][ "required" ] ) )
                                    @include( "users/player/partials.building-require", [ "name" => $buildings[ "iron" ][ "key" ] ] )
                                @endif
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
