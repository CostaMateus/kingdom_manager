@extends( "layouts.game" )

@section( "title", $buildings->farm->name )

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
                            "title"    => "Capacidade por nível",
                            "field"    => "max_pop",
                            "uni"      => "",
                            "building" => $buildings->farm
                        ] )

                        {{-- TODO --}}
                        {{-- não implementado --}}
                        @include( "users/player/partials.warning", [ "warning_text" => "Recurso incompleto! Status 60%" ] )

                        <div class="row mt-4" >

                            @if ( $village->building_farm > 0 )
                                @php
                                    $farm = $village->buildings->on->farm;
                                @endphp

                                {{-- populacao --}}
                                <div class="col-12 col-xl-10 mx-auto" >
                                    <div class="table-responsive" >
                                        <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>População</th>
                                                    <th class="text-center" >Nível atual</th>
                                                    @if ( $farm->level != $farm->max_level )
                                                        <th class="text-center" >Próximo nível</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$farm->key}.png" ) }}" alt="{{ $farm->name }}" >
                                                        População máxima atual
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ ( int ) ( $village->buildings->on->farm->max_pop ) }}
                                                    </td>
                                                    @if ( $farm->level != $farm->max_level )
                                                        <td class="border-bottom-0 text-center" >
                                                            {{ ( int ) ( $village->buildings->on->farm->max_pop * $village->buildings->on->farm->max_pop_factor ) }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>

                                        {{-- <p class="mt-3 mb-0 text-center fw-bold" >
                                            Tabela de população usada na:
                                            <br>
                                            - construção dos edifícios
                                            <br>
                                            - no exército
                                            <br>
                                            - em recrutamento
                                            <br>
                                            <br>
                                            Área da milícia
                                        </p> --}}

                                    </div>
                                </div>
                            @else
                                @include( "users/player/partials.building-require", [ "name" => $village->buildings->on->farm->key ] )
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
