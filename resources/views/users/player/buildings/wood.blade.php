@extends( "layouts.game" )

@section( "title", $buildings[ "wood" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "wood" ] ] )

                        <div class="row mt-4" >

                            @if ( $village->building_wood > 0 )
                                {{-- producao --}}
                                <div class="col-12 col-xl-9 mx-auto" >
                                    <div class="table-responsive" >
                                        <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Produção</th>
                                                    <th class="text-center" >Nível atual (por hora)</th>
                                                    @if ( $village->building_wood != $buildings[ "wood" ][ "max_level" ] )
                                                        <th class="text-center" >Próximo nível</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wood" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                        Produção atual
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ ( int ) ( $village->prod_wood * config( "game.speed" ) ) }}
                                                    </td>
                                                    @if ( $village->building_wood != $buildings[ "wood" ][ "max_level" ] )
                                                        <td class="border-bottom-0 text-center" >
                                                            {{ ( int ) ( $buildings[ "wood" ][ "wood_factor" ] * $village->prod_wood * config( "game.speed" ) ) }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @include( "users/player/partials.building-details", [
                                    "title"    => "Produção por nível",
                                    "field"    => "production",
                                    "uni"      => "/h",
                                    "building" => $buildings[ "wood" ]
                                ] )
                            @else
                                @if ( !empty( $buildings[ "wood" ][ "required" ] ) )
                                    @include( "users/player/partials.building-require", [ "name" => $buildings[ "wood" ][ "key" ] ] )
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
