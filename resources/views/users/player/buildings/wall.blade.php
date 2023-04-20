@extends( "layouts.game" )

@section( "title", $buildings->wall->name )

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
                            "title"    => "Percentual de defesa bônus por nível",
                            "field"    => "defense",
                            "uni"      => "%",
                            "building" => $buildings->wall
                        ] )

                        <div class="row mt-4" >

                            @if ( $village->building_wall > 0 )
                                @php
                                    $wall = $village->buildings->on->wall;
                                @endphp

                                {{-- defesa --}}
                                <div class="col-12 col-xl-10 mx-auto" >
                                    <div class="table-responsive" >
                                        <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Defesa</th>
                                                    <th class="text-center" >Nível atual</th>
                                                    @if ( $wall->level != $wall->max_level )
                                                        <th class="text-center" >Próximo nível</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        Percentual de defesa bônus
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ ( int ) ( $village->buildings->on->wall->defense ) }}%
                                                    </td>
                                                    @if ( $wall->level != $wall->max_level )
                                                        <td class="border-bottom-0 text-center" >
                                                            {{ ( int ) ( $village->buildings->on->wall->defense * $village->buildings->on->wall->defense_factor ) }}%
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                @include( "users/player/partials.building-require", [ "name" => $buildings->wall->key ] )
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
