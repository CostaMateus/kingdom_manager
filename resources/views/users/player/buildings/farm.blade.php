@extends( "layouts.game" )

@section( "title", $buildings[ "farm" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "farm" ] ] )

                        @if ( $village->building_farm > 0 )
                            {{-- populacao --}}
                            <div class="col-12 col-xl-9 mx-auto" >
                                <div class="table-responsive" >
                                    <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                        <thead>
                                            <tr>
                                                <th>População</th>
                                                <th>Nível atual</th>
                                                <th>Próximo nível</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-bottom-0" >
                                                    <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "farm" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "farm" ][ "name" ] }}" >
                                                    População máxima atual
                                                </td>
                                                <td class="border-bottom-0" >
                                                    {{ ( int ) ( $buildingsOn[ "farm" ][ "max_pop" ] ) }}
                                                </td>
                                                <td class="border-bottom-0" >
                                                    {{ ( int ) ( $buildingsOn[ "farm" ][ "max_pop" ] * $buildingsOn[ "farm" ][ "max_pop_factor" ] ) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    {{-- TODO --}}
                                    <p class="mt-3 mb-0 text-center fw-bold" >
                                        <span class="fs-3" >POR FAZER</span>
                                        <br>
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
                                    </p>

                                </div>
                            </div>
                        @else
                            @if ( !empty( $buildings[ "farm" ][ "required" ] ) )
                                @include( "users/player/partials.building-require", [ "name" => $buildings[ "farm" ][ "key" ] ] )
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
