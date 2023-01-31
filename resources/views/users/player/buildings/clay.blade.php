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
                            "uni"      => "/min",
                            "building" => $buildings[ "clay" ]
                        ] )

                        <div class="row mt-4" >

                            @if ( $village->building_clay > 0 )
                                @php
                                    $clay = $village->on->clay;
                                @endphp

                                {{-- producao --}}
                                <div class="col-12 col-xl-9 mx-auto" >
                                    <div class="table-responsive" >
                                        <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Produção</th>
                                                    <th class="text-center" >Nível atual (por minuto)</th>
                                                    @if ( $clay->level != $clay->max_level )
                                                        <th class="text-center" >Próximo nível</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$clay->key}.png" ) }}" alt="{{ $clay->name }}" >
                                                        Produção atual
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ number_format( $village->prod_clay, 0, ",", "." ) }}
                                                    </td>
                                                    @if ( $clay->level != $clay->max_level )
                                                        <td class="border-bottom-0 text-center" >
                                                            {{ number_format( ( $village->prod_clay * $clay->clay_factor ), 0, ",", "."  ) }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                @if ( !empty( $clay->required ) )
                                    @include( "users/player/partials.building-require", [ "name" => $clay->key ] )
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
