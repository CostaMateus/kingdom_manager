@extends( "layouts.game" )

@section( "title", $buildings->warehouse->name )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12 col-md-10 mx-auto" >
                <div class="card border-0" >
                    {{-- nome e pontuação da aldeia --}}
                    @include( "users/player/partials.building-name" )

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [
                            "title"    => "Capacidade por nível",
                            "field"    => "capacity",
                            "uni"      => "",
                            "building" => $buildings->warehouse
                        ] )

                        {{-- TODO --}}
                        {{-- não implementado --}}
                        @include( "users/player/partials.warning", [ "warning_text" => "Recurso incompleto! Status 70% )

                        <div class="row mt-4" >

                            @if ( $village->building_warehouse > 0 )
                                @php
                                    $warehouse = $village->buildings->on->warehouse;
                                @endphp

                                {{-- capacidade --}}
                                <div class="col-12 col-xl-10 mx-auto" >
                                    <div class="table-responsive" >
                                        <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Capacidade</th>
                                                    <th class="text-center" >Nível atual</th>
                                                    @if ( $warehouse->level != $warehouse->max_level )
                                                        <th class="text-center" >Próximo nível</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0" >
                                                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$warehouse->key}.png" ) }}" alt="{{ $warehouse->name }}" >
                                                        Capacidade atual por recurso
                                                    </td>
                                                    <td class="border-bottom-0 text-center" >
                                                        {{ ( int ) ( $village->buildings->on->warehouse->capacity ) }}
                                                    </td>
                                                    @if ( $warehouse->level != $warehouse->max_level )
                                                        <td class="border-bottom-0 text-center" >
                                                            {{ ( int ) ( $village->buildings->on->warehouse->capacity * $village->buildings->on->warehouse->capacity_factor ) }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>

                                        {{-- <p class="mt-3 mb-0 text-center fw-bold" >
                                            Tabela de quando cada recurso chegará ao limite do armazém
                                        </p> --}}

                                    </div>
                                </div>
                            @else
                                @include( "users/player/partials.building-require", [ "name" => $village->buildings->on->warehouse->key ] )
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
