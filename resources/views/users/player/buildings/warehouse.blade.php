@extends( "layouts.game" )

@section( "title", $buildings[ "warehouse" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "warehouse" ] ] )

                        @if ( $village->building_warehouse > 0 )
                            {{-- capacidade --}}
                            <div class="col-12 col-xl-9 mx-auto" >
                                <div class="table-responsive" >
                                    <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                        <thead>
                                            <tr>
                                                <th>Capacidade</th>
                                                <th>Nível atual</th>
                                                <th>Próximo nível</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-bottom-0" >
                                                    <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "warehouse" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "warehouse" ][ "name" ] }}" >
                                                    Capacidade atual por recurso
                                                </td>
                                                <td class="border-bottom-0" >
                                                    {{ ( int ) ( $buildingsOn[ "warehouse" ][ "capacity" ] ) }}
                                                </td>
                                                <td class="border-bottom-0" >
                                                    {{ ( int ) ( $buildingsOn[ "warehouse" ][ "capacity" ] * $buildingsOn[ "warehouse" ][ "capacity_factor" ] ) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    {{-- TODO --}}
                                    <p class="mt-3 mb-0 text-center fw-bold" >
                                        <span class="fs-3" >POR FAZER</span>
                                        <br>
                                        Tabela de quando cada recurso chegará ao limite do armazém
                                    </p>

                                </div>
                            </div>
                        @else
                            @if ( !empty( $buildings[ "warehouse" ][ "required" ] ) )
                                @include( "users/player/partials.building-require", [ "name" => $buildings[ "warehouse" ][ "key" ] ] )
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
