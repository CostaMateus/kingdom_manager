@extends( "layouts.game" )

@section( "title", "Início" )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >
            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-body" >

                        <div class="table-responsive" >
                            <table id="villages" class="table table-hover table-sm align-middle mb-0" >
                                <thead>
                                    @php
                                        $arrs = [ "main", "barracks", "stable", "workshop", "smithy", "farm", "market", ];
                                    @endphp
                                    <tr>
                                        <th >Total: {{ $villages->count() }}</th>
                                        @foreach ( $buildings as $key => $building )
                                            @if ( in_array( $key, $arrs ) )
                                                <th class="text-center" title="{{ $building[ "name" ] }}" alt="{{ $building[ "name" ] }}" >
                                                    <img width="15" height="15" src="{{ asset( "assets/graphic/buildings/icons/{$key}.png" ) }}" >
                                                </th>
                                            @endif
                                        @endforeach

                                        @foreach ( $units as $key => $unit )
                                            @if ( $key != "militia" )
                                                <th class="text-center" title="{{ $unit[ "name" ] }}" alt="{{ $unit[ "name" ] }}" >
                                                    <img width="15" height="15" src="{{ asset( "assets/graphic/units/icons/{$key}.png" ) }}" >
                                                </th>
                                            @endif
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $villages as $id => $village )
                                        <tr class="align-middle" >
                                            <td class="d-flex align-items-center h-100 py-1" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.overview", [ "village" => $village ] ) }}" >
                                                    {{ $village->name }}
                                                </a>
                                            </td>

                                            {{-- edificio principal --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.main", [ "village" => $village ] ) }}" >
                                                    @if ( $village->building_main == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" alt="Não construído" ></i>
                                                    @else
                                                        {{-- verificar se há construções/exercito na fila --}}
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" alt="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- quartel --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.barracks", [ "village" => $village ] ) }}" >
                                                    @if ( $village->building_barracks == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" alt="Não construído" ></i>
                                                    @else
                                                        {{-- verificar se há construções/exercito na fila --}}
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" alt="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- estabulo --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.stable", [ "village" => $village ] ) }}" >
                                                    @if ( $village->building_stable == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" alt="Não construído" ></i>
                                                    @else
                                                        {{-- verificar se há construções/exercito na fila --}}
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" alt="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- oficina --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.workshop", [ "village" => $village ] ) }}" >
                                                    @if ( $village->building_workshop == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" alt="Não construído" ></i>
                                                    @else
                                                        {{-- verificar se há construções/exercito na fila --}}
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" alt="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- forja --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.smithy", [ "village" => $village ] ) }}" >
                                                    @if ( $village->building_smithy == 0 )
                                                        <i class="bi-05 bi-circle-fill text-danger" title="Não construído" alt="Não construído" ></i>
                                                    @elseif ( $village->full_research )
                                                        <i class="bi-05 bi-circle-fill text-success" title="Pesquisa completada" alt="Pesquisa completada" ></i>
                                                    @else
                                                        <i class="bi-05 bi-circle-fill text-black-50" title="Sem itens na fila" alt="Sem itens na fila" ></i>
                                                    @endif
                                                </a>
                                            </td>

                                            {{-- fazenda --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.farm", [ "village" => $village ] ) }}" >
                                                    0/0
                                                    {{-- fazer calculo de população usada/total --}}
                                                </a>
                                            </td>

                                            {{-- mercado --}}
                                            <td class="text-center" >
                                                <a class="btn btn-sm btn-link text-black text-decoration-none" href="{{ route( "village.market", [ "village" => $village ] ) }}" >
                                                    0/0
                                                    {{-- fazer o calculo de mercadores disponiveis --}}
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
