@extends( "layouts.game" )

@section( "title", "Início" )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            <div class="col-12 col-md-10 mx-auto" >
                <div class="card border-0" >
                    <div class="card-body" >

                        <div class="table-responsive table-fixed " >
                            <table id="villages" class="table table-hover table-sm align-middle mb-0" >
                                <thead class="table-head" >
                                    @php
                                        $arrs = [ "main", "barracks", "stable", "workshop", "smithy", "farm", "market", ];
                                    @endphp
                                    <tr>
                                        <th scope="col"                                      style="min-width:150px" >
                                            Total: {{ count( $villages ) }}
                                        </th>
                                        <th scope="col" class="text-center" title="Pontos"   style="min-width:60px" >
                                            Pontos
                                        </th>
                                        <th scope="col" class="text-center" title="Recursos" style="min-width:100px" >
                                            Recursos
                                        </th>
                                        <th scope="col" class="text-center" title="Armazém"  style="min-width:100px" >
                                            Armazém
                                        </th>
                                        <th scope="col" class="text-center" title="Fazenda"  style="min-width:100px" >
                                            Fazenda
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $villages as $village )
                                        <tr class="align-middle" >
                                            <th scope="row" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.overview", [ "village" => $village ] ) }}" >
                                                    {{ $village->name }}
                                                </a>
                                            </th>

                                            {{-- pontos --}}
                                            <td class="text-center" >
                                                {{ ( int ) $village->points }}
                                            </td>

                                            {{-- recursos --}}
                                            <td class="text-center" >
                                                @php
                                                    $wood = ( property_exists( $village->buildings->on, "wood" ) )
                                                                ? $village->buildings->on->wood
                                                                : $village->buildings->off->wood;

                                                    $clay = ( property_exists( $village->buildings->on, "clay" ) )
                                                                ? $village->buildings->on->clay
                                                                : $village->buildings->off->clay;

                                                    $iron = ( property_exists( $village->buildings->on, "iron" ) )
                                                                ? $village->buildings->on->iron
                                                                : $village->buildings->off->iron;
                                                @endphp
                                                <div class="row mx-auto" >
                                                    <div class="px-1 col-12 col-lg-4" title="{{ $wood->name }}" >
                                                        <img src="{{ asset( "assets/graphic/buildings/icons/{$wood->key}.png" ) }}" alt="{{ $wood->name }}" >
                                                        {{ ( int ) $village->stored_wood }}
                                                    </div>
                                                    <div class="px-1 col-12 col-lg-4" title="{{ $clay->name }}" >
                                                        <img src="{{ asset( "assets/graphic/buildings/icons/{$clay->key}.png" ) }}" alt="{{ $clay->name }}" >
                                                        {{ ( int ) $village->stored_clay }}
                                                    </div>
                                                    <div class="px-1 col-12 col-lg-4" title="{{ $iron->name }}" >
                                                        <img src="{{ asset( "assets/graphic/buildings/icons/{$iron->key}.png" ) }}" alt="{{ $iron->name }}" >
                                                        {{ ( int ) $village->stored_iron }}
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- armazem --}}
                                            <td class="text-center" >
                                                {{ ( int ) $village->buildings->on->warehouse->capacity }}
                                            </td>

                                            {{-- fazenda --}}
                                            <td class="text-center" >
                                                {{ ( int ) $village->pop }}/{{ ( int ) $village->buildings->on->farm->max_pop }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
