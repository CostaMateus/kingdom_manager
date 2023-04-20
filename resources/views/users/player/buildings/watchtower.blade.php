@extends( "layouts.game" )

@section( "title", $buildings->watchtower->name )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-10 mx-auto" >
                <div class="card border-0" >
                    {{-- nome e pontuação da aldeia --}}
                    @include( "users/player/partials.building-name" )

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [
                            "title"    => "Alcance por nível",
                            "field"    => "range",
                            "uni"      => " campos",
                            "building" => $buildings->watchtower
                        ] )

                        <div class="row mt-4" >

                            @if ( $village->building_watchtower > 0 )
                                @php
                                    $watchtower = $village->buildings->on->watchtower;
                                @endphp

                                {{-- visao --}}
                                <div class="col-12 col-xl-10 mx-auto" >
                                    <div class="table-responsive" >
                                        <table class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Visão da torre</th>
                                                    <th class="text-center" >Nível atual</th>
                                                    @if ( $watchtower->level != $watchtower->max_level )
                                                        <th class="text-center" >Próximo nível</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        Alcanse da visão
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ ( int ) ( $village->buildings->on->watchtower->range ) }} campos
                                                    </td>
                                                    @if ( $watchtower->level != $watchtower->max_level )
                                                        <td class="border-bottom-0 text-center" >
                                                            {{ ( int ) ( $village->buildings->on->watchtower->range * $village->buildings->on->watchtower->range_factor ) }} campos
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-10 mx-auto mt-5" >
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
                            @else
                                @include( "users/player/partials.building-require", [ "name" => $buildings->watchtower->key ] )
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
