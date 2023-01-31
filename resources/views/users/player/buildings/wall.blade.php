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
                        @include( "users/player/partials.building-description", [
                            "title"    => "Percentual de defesa bônus por nível",
                            "field"    => "defense",
                            "uni"      => "%",
                            "building" => $buildings[ "wall" ]
                        ] )

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
