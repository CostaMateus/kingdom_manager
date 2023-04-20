@extends( "layouts.game" )

@section( "title", "Visão geral" )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class=col-12 col-md-10 mx-auto >
                <div class="card border-0" >

                    <div class="card-body px-3" >
                        <div class="row" >

                            {{-- edificios --}}
                            <div class="col-12 col-md-8" >
                                <div class="row" >
                                    <div class="col-12 text-center" >
                                        <p class="fw-bold h3 mb-0" >Edifícios</p>
                                    </div>

                                    @foreach ( $village->buildings->on as $key => $building )
                                        @php
                                            $class = "";

                                            if ( in_array( $loop->iteration, [ 1, 4, 7, 10, 13, 16 ] ) )
                                                $class .= " ps-2 pe-1 ps-xl-2 pe-xl-1";
                                            elseif ( in_array( $loop->iteration, [ 3, 6, 9, 12, 15, 18 ] ) )
                                                $class .= " ps-1 pe-2 ps-xl-1 pe-xl-2";
                                            else
                                                $class .= " px-1 px-xl-1";

                                            $class .= ( $loop->iteration % 2 == 0 ) ? " ps-md-1 pe-md-2" : " ps-md-2 pe-md-1";

                                            $png = Helper::getLevelImage( $key, $building->level );
                                            $img = "{$key}{$png}.png";
                                        @endphp

                                        <div class="col-4 col-md-6 col-xl-4 my-1 {{ $class }}" title="{{ $building->name }}" >
                                            <a class="text-decoration-none text-dark" href="{{ route( "village.{$key}", [ "village" => $village ]) }}" >
                                                <div class="small-box h-100 d-flex flex-column justify-content-center border border-dark-subtle border-opacity-10 rounded" >
                                                    <img class="mx-auto" src="{{ asset( "assets/graphic/buildings/resized/{$img}" ) }}" alt="{{ $building->name }}" >
                                                    <div class="mx-auto text-center p-2" >
                                                        <h5 class="mb-0" >
                                                            {{ $building->name }}
                                                        </h5>
                                                        <span class="text-muted small" >
                                                            @if ( $village->{"building_{$key}"} == 0 )
                                                                (Não construído)
                                                            @else
                                                                (Nível {{ $village->{"building_{$key}"} }})
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- producao / exército / lealdade --}}
                            <div class="col-12 col-md-4" >
                                <div class="row" >

                                    {{-- producao --}}
                                    <div class="col-12" >
                                        <div class="table-responsive" >
                                            <table id="overview-production" class="table table-hover table-sm align-middle" >
                                                <thead>
                                                    <tr>
                                                        <th scope="col" >Produção</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="d-flex align-items-center h-100 py-1" title="{{ $buildings->wood->name }}" >
                                                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings->wood->key}.png" ) }}" alt="{{ $buildings->wood->name }}" >
                                                            <p class="flex-fill my-0 ms-2" >
                                                                {{ ( int ) $village->prod_wood }} <span>por hora</span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex align-items-center h-100 py-1" title="{{ $buildings->clay->name }}" >
                                                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings->clay->key}.png" ) }}" alt="{{ $buildings->clay->name }}" >
                                                            <p class="flex-fill my-0 ms-2" >
                                                                {{ ( int ) $village->prod_clay }} <span>por hora</span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="d-flex align-items-center h-100 py-1" title="{{ $buildings->iron->name }}" >
                                                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings->iron->key}.png" ) }}" alt="{{ $buildings->iron->name }}" >
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
                                    <div class="col-12" >
                                        <div class="table-responsive" >
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
                                    <div class="col-12" >
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
