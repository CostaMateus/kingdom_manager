@extends( "layouts.game" )

@section( "title", $buildings[ "clay" ][ "name" ] )

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
                            "title"    => "Produção por nível",
                            "field"    => "production",
                            "uni"      => "/h",
                            "building" => $buildings[ "clay" ]
                        ] )

                        <div class="row mt-4" >

                            @if ( $village->building_clay > 0 )
                                {{-- producao --}}
                                <div class="col-12 col-xl-9 mx-auto" >
                                    <div class="table-responsive" >
                                        <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Produção</th>
                                                    <th class="text-center" >Nível atual (por hora)</th>
                                                    @if ( $village->building_clay != $buildings[ "clay" ][ "max_level" ] )
                                                        <th class="text-center" >Próximo nível</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "clay" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                        Produção atual
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ ( int ) ( $village->prod_clay * config( "game.speed" ) ) }}
                                                    </td>
                                                    @if ( $village->building_clay != $buildings[ "clay" ][ "max_level" ] )
                                                        <td class="border-bottom-0 text-center" >
                                                            {{ ( int ) ( $buildings[ "clay" ][ "clay_factor" ] * $village->prod_clay * config( "game.speed" ) ) }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                @if ( !empty( $buildings[ "clay" ][ "required" ] ) )
                                    @include( "users/player/partials.building-require", [ "name" => $buildings[ "clay" ][ "key" ] ] )
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
