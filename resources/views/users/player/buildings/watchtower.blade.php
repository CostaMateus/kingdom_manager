@extends( "layouts.game" )

@section( "title", $buildings[ "watchtower" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [
                            "title"    => "Alcance por nível",
                            "field"    => "range",
                            "uni"      => " campos",
                            "building" => $buildings[ "watchtower" ]
                        ] )

                        <div class="row mt-4" >

                            @if ( $village->building_watchtower > 0 )
                                {{-- capacidade --}}
                                <div class="col-12 col-xl-5 ms-auto" >
                                    <p class="fs-3 fw-bold mb-0" >Torre ativa</p>
                                    <p>
                                        Sua Torre de vigia está ativa e verificando ataques em suas aldeias. Quando um ataque estiver no alcance da torre ficará disponível. Ataques a caminho que eventualmente serão detectados pela torre de vigia serão marcados com o símbolo de um olho.
                                    </p>

                                    <p class="fs-3 fw-bold mb-0" >Tipos de ataque</p>
                                    <p class="mb-0" >
                                        <img src="{{ asset( "assets/graphic/attack/attack_small.png"    ) }}" alt="Ataque pequeno" >
                                        Ataque pequeno (1 a 1000 tropas)
                                    </p>
                                    <p class="mb-0" >
                                        <img src="{{ asset( "assets/graphic/attack/attack_medium.png"   ) }}" alt="Ataque médio" >
                                        Ataque médio (1000 a 5000 tropas)
                                    </p>
                                    <p class="mb-0" >
                                        <img src="{{ asset( "assets/graphic/attack/attack_large.png"    ) }}" alt="Ataque grande" >
                                        Ataque grande (5000+ tropas)
                                    </p>
                                    <p class="mb-0" >
                                        <img src="{{ asset( "assets/graphic/attack/attack_noble.png"    ) }}" alt="Ataque com nobre" >
                                        Ataque com nobre
                                    </p>
                                    <p class="mb-0" >
                                        <img src="{{ asset( "assets/graphic/attack/attack_detected.png" ) }}" alt="Ataque detectado" >
                                        Ataque será detectado por uma torre vigia
                                    </p>
                                </div>

                                <div class="col-12 col-xl-5 me-auto" >
                                    <div class="table-responsive" >
                                        <table class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr class="text-center" >
                                                    <th colspan="2" >Visão da torre</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $wt_max = $buildingsOn[ "watchtower" ][ "max_level"    ];
                                                    $base   = $buildingsOn[ "watchtower" ][ "range"        ];
                                                    $rate   = $buildingsOn[ "watchtower" ][ "range_factor" ];
                                                @endphp
                                                @foreach ( range( 1, $wt_max ) as $i )
                                                    @php
                                                        $cal   = $base * $rate;
                                                        $base  = $cal;
                                                        $base2 = $cal;
                                                    @endphp
                                                    <tr class="text-center" >
                                                        <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                            Nível {{ $i }}
                                                        </td>
                                                        <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                            {{ ( int ) ( $base2 ) }} campos
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                @if ( !empty( $buildings[ "watchtower" ][ "required" ] ) )
                                    @include( "users/player/partials.building-require", [ "name" => $buildings[ "watchtower" ][ "key" ] ] )
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
