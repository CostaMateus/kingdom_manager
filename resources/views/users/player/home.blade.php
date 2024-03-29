@extends( "layouts.game" )

@section( "title", "Início" )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            <div class="col-12 col-md-10 mx-auto"  >
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
                                            Total: {{ $villages->count() }}
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
                                    @foreach ( $villages as $v )
                                        <tr class="align-middle" >
                                            <th scope="row" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.overview", [ "village" => $v ] ) }}" >
                                                    {{ $v->name }}
                                                </a>
                                            </th>

                                            {{-- pontos --}}
                                            <td class="text-center" >
                                                {{ ( int ) $v->points }}
                                            </td>

                                            {{-- recursos --}}
                                            <td class="text-center" >
                                                @php
                                                    $wood    = ( property_exists( $v->buildings->on, "wood" ) )
                                                                ? $v->buildings->on->wood
                                                                : $v->buildings->off->wood;

                                                    $clay    = ( property_exists( $v->buildings->on, "clay" ) )
                                                                ? $v->buildings->on->clay
                                                                : $v->buildings->off->clay;

                                                    $iron    = ( property_exists( $v->buildings->on, "iron" ) )
                                                                ? $v->buildings->on->iron
                                                                : $v->buildings->off->iron;

                                                    $class_w = $v->stored_wood >= ( 0.9 * $v->buildings->on->warehouse->capacity ) ? "text-danger" : "";
                                                    $class_c = $v->stored_clay >= ( 0.9 * $v->buildings->on->warehouse->capacity ) ? "text-danger" : "";
                                                    $class_i = $v->stored_iron >= ( 0.9 * $v->buildings->on->warehouse->capacity ) ? "text-danger" : "";

                                                @endphp
                                                <div class="row mx-auto" >
                                                    <div class="px-1 col-12 col-lg-4 {{ $class_w }}" title="{{ $wood->name }}" >
                                                        <img src="{{ asset( "assets/graphic/buildings/icons/{$wood->key}.png" ) }}" alt="{{ $wood->name }}" >
                                                        <span>{{ ( int ) $v->stored_wood }}</span>
                                                    </div>
                                                    <div class="px-1 col-12 col-lg-4 {{ $class_c }}" title="{{ $clay->name }}" >
                                                        <img src="{{ asset( "assets/graphic/buildings/icons/{$clay->key}.png" ) }}" alt="{{ $clay->name }}" >
                                                        <span>{{ ( int ) $v->stored_clay }}</span>
                                                    </div>
                                                    <div class="px-1 col-12 col-lg-4 {{ $class_i }}" title="{{ $iron->name }}" >
                                                        <img src="{{ asset( "assets/graphic/buildings/icons/{$iron->key}.png" ) }}" alt="{{ $iron->name }}" >
                                                        <span>{{ ( int ) $v->stored_iron }}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- armazem --}}
                                            <td class="text-center" >
                                                {{ ( int ) $v->buildings->on->warehouse->capacity }}
                                            </td>

                                            {{-- fazenda --}}
                                            <td class="text-center" >
                                                {{ ( int ) $v->pop }}/{{ ( int ) $v->buildings->on->farm->max_pop }}
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
