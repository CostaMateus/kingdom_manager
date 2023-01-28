@extends( "layouts.game" )

@section( "title", $buildings[ "wall" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "wall" ] ] )

                        <div class="row mt-4" >

                            @if ( $village->building_wall > 0 )
                                {{-- defesa --}}
                                <div class="col-12 col-xl-9 mx-auto" >
                                    <div class="table-responsive" >
                                        <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Defesa</th>
                                                    <th class="text-center" >Nível atual</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        {{-- <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wall" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "farm" ][ "name" ] }}" > --}}
                                                        Percentual de defesa bônus
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ ( int ) ( $buildingsOn[ "wall" ][ "defense" ] ) }}%
                                                    </td>
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
                                                    <th colspan="2" >Percentual de defesa bônus por nível</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $wt_max = $buildings[ "wall" ][ "max_level"      ];
                                                    $base   = $buildings[ "wall" ][ "defense"        ];
                                                    $rate   = $buildings[ "wall" ][ "defense_factor" ];
                                                @endphp
                                                @foreach ( range( 1, $wt_max ) as $i )
                                                    @php
                                                        $base2 = $base;

                                                        if ($i > 1)
                                                        {
                                                            $cal   = $base * $rate;
                                                            $base2 = round( $cal, 0, PHP_ROUND_HALF_DOWN );
                                                            $base  = $cal;
                                                        }
                                                    @endphp
                                                    <tr class="text-center @if ($i == $village->building_wall) table-active @endif" >
                                                        <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                            Nível {{ $i }}
                                                        </td>
                                                        <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                            {{ ( int ) ( $base2 ) }}%
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            @else
                                @if ( !empty( $buildings[ "wall" ][ "required" ] ) )
                                    @include( "users/player/partials.building-require", [ "name" => $buildings[ "wall" ][ "key" ] ] )
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
