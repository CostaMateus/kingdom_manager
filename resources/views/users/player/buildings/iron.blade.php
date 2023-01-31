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
                        @include( "users/player/partials.building-description", [
                            "title"    => "Produção por nível",
                            "field"    => "production",
                            "uni"      => "/min",
                            "building" => $buildings[ "iron" ]
                        ] )

                        <div class="row mt-4" >
                            @php
                                $iron = ( property_exists( $village->on, "iron" ) ) ? $village->on->iron : $$village->off->iron;
                            @endphp
                            @if ( $iron->level > 0 )
                                {{-- producao --}}
                                <div class="col-12 col-xl-9 mx-auto" >
                                    <div class="table-responsive" >
                                        <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Produção</th>
                                                    <th class="text-center" >Nível atual (por minuto)</th>
                                                    @if ( $iron->level != $iron->max_level )
                                                        <th class="text-center" >Próximo nível</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$iron->key}.png" ) }}" alt="{{ $iron->name }}" >
                                                        Produção atual
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ number_format( $village->prod_iron, 0, ",", "." ) }}
                                                    </td>
                                                    @if ( $iron->level != $iron->max_level )
                                                        <td class="border-bottom-0 text-center" >
                                                            {{ number_format( ( $village->prod_iron * $iron->iron_factor ), 0, ",", "."  ) }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                @if ( !empty( $iron->required ) )
                                    @include( "users/player/partials.building-require", [ "name" => $iron->key ] )
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
