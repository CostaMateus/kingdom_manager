@extends( "layouts.game" )

@section( "title", "Visão geral" )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >

                    {{--
                        /**
                         * TODO redesenhar essa tela, ta feio
                         */
                    --}}

                    <div class="card-body" >
                        <div class="row">
                            {{-- edificios --}}
                            <div class="col-12 col-sm-6">
                                <div class="table-responsive" >
                                    <table id="overview-buildings" class="table table-hover table-sm align-middle mb-3 mb-sm-0" >
                                        <thead>
                                            <tr>
                                                <th scope="col" >Edifícios</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $buildings as $key => $building )
                                                <tr class="align-middle" >
                                                    <td class="d-flex align-items-center h-100 py-1" title="{{ $building[ "name" ] }}" >
                                                        <img src="{{ asset( "assets/graphic/buildings/{$key}1.png" ) }}" alt="{{ $building[ "name" ] }}" >
                                                        <a class="btn btn-link text-black text-decoration-none"
                                                            href="{{ route( "village.{$key}", [ "village" => $village ]) }}" >
                                                            {{ $building[ "name" ] }}
                                                            <span class="text-muted" >
                                                                @if ( $village->{"building_{$key}"} == 0 )
                                                                    (Não construído)
                                                                @else
                                                                    (Nível {{ $village->{"building_{$key}"} }})
                                                                @endif
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="row">

                                    {{-- producao --}}
                                    <div class="col-12">
                                        <div class="table-responsive" >
                                            <table id="overview-production" class="table table-hover table-sm align-middle" >
                                                <thead>
                                                    <tr>
                                                        <th scope="col" >Produção</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="d-flex align-items-center h-100 py-1" title="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wood" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                            <p class="flex-fill my-0 ms-2" >
                                                                {{ ( int ) $village->prod_wood }} <span>por hora</span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex align-items-center h-100 py-1" title="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "clay" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                            <p class="flex-fill my-0 ms-2" >
                                                                {{ ( int ) $village->prod_clay }} <span>por hora</span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex align-items-center h-100 py-1" title="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                            <p class="flex-fill my-0 ms-2" >
                                                                {{ ( int ) $village->prod_iron }} <span>por hora</span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- exército --}}
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="overview-army" class="table table-hover table-sm align-middle" >
                                                <thead>
                                                    <tr>
                                                        <th scope="col" >Exército</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ( $units as $key => $unit )
                                                        @if ( $key != "militia" )
                                                            {{--
                                                                /**
                                                                 * TODO não exibir qnd não tiver tropas da unidade
                                                                 */
                                                            --}}
                                                            <tr>
                                                                <td class="d-flex align-items-center h-100 py-1" title="{{ $unit[ "name" ] }}" >
                                                                    <img width="15" src="{{ asset( "assets/graphic/units/icons/{$key}.png" ) }}" alt="{{ $unit[ "name" ] }}" >
                                                                    <p class="flex-fill my-0 ms-2" >
                                                                        0 {{ $unit[ "name" ] }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- lealdade --}}
                                    <div class="col-12">
                                        <div class="table-responsive" >
                                            <table id="overview-loyalty" class="table table-hover table-sm align-middle mb-0" >
                                                <thead>
                                                    <tr>
                                                        <th scope="col" >Lealdade</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="d-flex align-items-center h-100 py-1" title="Lealdade" >
                                                            <img width="15" src="{{ asset( "assets/graphic/loyalty.png" ) }}" alt="Lealdade" >
                                                            <p class="flex-fill my-0 ms-2" >
                                                                {{ $village->loyalty }}<span>%</span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
