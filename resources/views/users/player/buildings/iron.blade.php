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

                        @if ( $village->building_iron > 0 )
                            <div class="col-12 col-xl-9 mx-auto" >
                                <div class="table-responsive" >
                                    <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                        <thead>
                                            <tr>
                                                <th>Produção</th>
                                                <th>Nível atual (por hora)</th>
                                                <th>Próximo nível</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-bottom-0" >
                                                    <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                    Produção atual
                                                </td>
                                                <td class="border-bottom-0" >
                                                    {{ ( int ) ( $village->prod_iron * config( "game.speed" ) ) }}
                                                </td>
                                                <td class="border-bottom-0" >
                                                    {{ ( int ) ( $village->prod_iron * config( "game.speed" ) * $buildings[ "iron" ][ "iron_factor" ] ) }}
                                                </td>
                                            </tr>
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
@endsection

@include( "users/player/partials.update-resources" )
