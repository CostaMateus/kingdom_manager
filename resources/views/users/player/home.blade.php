@extends( "layouts.game" )

@section( "title", "Início" )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-body" >

                        {{--
                            /**
                              * TODO ajeitar os dados de mercadores de cada aldeia
                              */
                        --}}

                        <div class="table-responsive table-fixed " >
                            <table id="villages" class="table table-hover table-sm align-middle mb-0" >
                                <thead class="table-head" >
                                    @php
                                        $arrs = [ "main", "barracks", "stable", "workshop", "smithy", "farm", "market", ];
                                    @endphp
                                    <tr>
                                        <th scope="col" >Total: {{ count( $villages ) }}</th>
                                        @foreach ( $buildings as $key => $building )
                                            @if ( in_array( $key, $arrs ) )
                                                <th scope="col" class="text-center" title="{{ $building[ "name" ] }}" >
                                                    <img width="15" height="15" src="{{ asset( "assets/graphic/buildings/icons/{$key}.png" ) }}" alt="{{ $building[ "name" ] }}"  >
                                                </th>
                                            @endif
                                        @endforeach

                                        @foreach ( $units as $key => $unit )
                                            @if ( $key != "militia" )
                                                <th scope="col" class="text-center" title="{{ $unit[ "name" ] }}" >
                                                    <img width="15" height="15" src="{{ asset( "assets/graphic/units/icons/{$key}.png" ) }}" alt="{{ $unit[ "name" ] }}" >
                                                </th>
                                            @endif
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $villages as $village )
                                        <tr class="align-middle" >
                                            <th scope="row" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.overview", [ "village" => $village->id ] ) }}" >
                                                    {{ $village->name }}
                                                </a>
                                            </th>

                                            {{-- edificio principal --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.main", [ "village" => $village->id ] ) }}" >
                                                    @if ( $village->building_main == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" ></i>
                                                    @elseif ( ( $count = $village->buildEvents->count() ) > 0 )
                                                        <i class="bi-05 bi-circle-fill text-success" title="{{ $count }} edifício(s) em construção" ></i>
                                                    @else
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- quartel --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.barracks", [ "village" => $village->id ] ) }}" >
                                                    @if ( $village->building_barracks == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" ></i>
                                                    @else
                                                        {{-- verificar se há construções/exército na fila --}}
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- estabulo --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.stable", [ "village" => $village->id ] ) }}" >
                                                    @if ( $village->building_stable == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" ></i>
                                                    @else
                                                        {{-- verificar se há construções/exército na fila --}}
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- oficina --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.workshop", [ "village" => $village->id ] ) }}" >
                                                    @if ( $village->building_workshop == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" ></i>
                                                    @else
                                                        {{-- verificar se há construções/exército na fila --}}
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- forja --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.smithy", [ "village" => $village->id ] ) }}" >
                                                    @if ( $village->building_smithy == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" ></i>
                                                    @elseif ( $village->full_research )
                                                        <i class="bi-05 bi-circle-fill text-success" title="Pesquisa completada" ></i>
                                                    @else
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- mercado --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.market", [ "village" => $village->id ] ) }}" >
                                                    0/0
                                                    {{-- fazer o calculo de mercadores disponiveis --}}
                                                </a>
                                            </td>

                                            {{-- fazenda --}}
                                            <td class="text-center" >
                                                @php
                                                    $class_pop = ( $village->pop >= ( 0.9 * $village->buildings->on->farm->max_pop ) ) ? "text-danger" : "";
                                                    $pop       = ( int ) $village->buildings->on->farm->max_pop - ( int ) $village->pop;
                                                    $level     = $village->buildings->on->farm->level;
                                                @endphp
                                                <a class="btn btn-sm btn-link text-black text-decoration-none {{ $class_pop }}" href="{{ route( "village.farm", [ "village" => $village->id ] ) }}"
                                                    title="População disponível (Nível)" >
                                                    {{ $pop }} ({{ $level }})
                                                </a>
                                            </td>

                                            @foreach ( $units as $key => $unit )
                                                @if ( $key != "militia" )
                                                    <td class="text-center" >0</td>
                                                @endif
                                            @endforeach
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
