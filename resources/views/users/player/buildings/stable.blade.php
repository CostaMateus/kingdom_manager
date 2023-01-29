@extends( "layouts.game" )

@section( "title", $buildings[ "stable" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "stable" ] ] )

                        {{-- não implementado --}}
                        @include( "users/player/partials.warning", [ "warning_text" => "Recrutamento de cavalaria não implementado!" ] )

                        <div class="row" >

                            @if ( $village->building_stable > 0 )
                                @if ( !empty( $unitsOn ) )
                                    {{-- unidades pesquisadas --}}
                                    <div class="col-12 col-xl-9 mx-auto" >
                                        <div class="table-responsive" >
                                            <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                                <thead>
                                                    <tr>
                                                        <th>Unidades</th>
                                                        <th>Requerimentos</th>
                                                        <th class="text-center" >Na aldeia/Total</th>
                                                        <th class="d-none d-sm-table-cell text-center" >Recrutar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <form id="form-units" method="POST" action="#" >
                                                        @csrf
                                                        @foreach ( $unitsOn as $key => $unit )
                                                            @php
                                                                $class      = "success";
                                                                $disabled   = "";

                                                                $class_wood = "";
                                                                $lack_wood  = false;

                                                                $class_clay = "";
                                                                $lack_clay  = false;

                                                                $class_iron = "";
                                                                $lack_iron  = false;

                                                                $class_pop  = "";
                                                                $lack_pop   = false;

                                                                if ( $unit[ "wood" ] > $village->stored_wood )
                                                                {
                                                                    $class_wood = "text-danger";
                                                                    $lack_wood  = true;
                                                                }

                                                                if ( $unit[ "clay" ] > $village->stored_clay )
                                                                {
                                                                    $class_clay = "text-danger";
                                                                    $lack_clay  = true;
                                                                }

                                                                if ( $unit[ "iron" ] > $village->stored_iron )
                                                                {
                                                                    $class_iron = "text-danger";
                                                                    $lack_iron  = true;
                                                                }

                                                                $free_pop = $buildingsOn[ "farm" ][ "max_pop" ] - $village->pop;

                                                                if ( $free_pop < 0 || $unit[ "pop" ] > $free_pop )
                                                                {
                                                                    $class_pop  = "text-danger";
                                                                    $lack_pop   = true;
                                                                }

                                                                if ( $lack_wood || $lack_clay || $lack_iron || $lack_pop )
                                                                {
                                                                    $class      = "secondary";
                                                                    $disabled   = "disabled";
                                                                }
                                                            @endphp

                                                            <tr>
                                                                <td>
                                                                    <div class="row mx-auto" >
                                                                        <div class="col-12 col-lg-4 text-center ps-lg-0 m-auto" >
                                                                            <img src="{{ asset( "assets/graphic/units/icons/{$key}.png" ) }}" alt="" >
                                                                        </div>
                                                                        <div class="col-12 col-lg-8 text-center text-lg-start ps-lg-0 m-auto" >
                                                                            <a class="text-decoration-none text-dark" href="#" >
                                                                                <p class="mb-0" >{{ $unit[ "name" ] }}</a>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="row mx-auto" >
                                                                        <div class="px-1 col-12 col-sm-4 col-lg-2 {{ $class_wood }}" title="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                                            <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wood" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                                            {{ $unit[ "wood" ] }}
                                                                        </div>
                                                                        <div class="px-1 col-12 col-sm-4 col-lg-2 {{ $class_clay }}" title="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                                            <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "clay" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                                            {{ $unit[ "clay" ] }}
                                                                        </div>
                                                                        <div class="px-1 col-12 col-sm-4 col-lg-2 {{ $class_iron }}" title="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                                            <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                                            {{ $unit[ "iron" ] }}
                                                                        </div>
                                                                        <div class="px-1 col-12 col-sm-4 col-lg-2 {{ $class_pop }}" title="População" >
                                                                            <img src="{{ asset( "assets/graphic/buildings/icons/pop.png" ) }}" alt="População" >
                                                                            {{ $unit[ "pop"  ] }}
                                                                        </div>
                                                                        <div class="px-1 col-12 col-sm-8 col-lg-4" title="Tempo" >
                                                                            <img src="{{ asset( "assets/graphic/buildings/icons/time.png" ) }}" alt="Tempo" >
                                                                            {{ $unit[ "build_time" ] }}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center" >
                                                                    <div class="row mx-auto" >
                                                                        <div class="col-12" >
                                                                            <div>0/0</div>
                                                                        </div>
                                                                        <div class="col-12 d-block d-sm-none" >
                                                                            <input class="form-control form-control-sm" {{ $disabled }} type="number" name="{{ $key }}" id="unit-{{ $key }}" size="5" min="0" max="99999" step="1" >
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="d-none d-sm-table-cell text-center" >
                                                                    <input class="form-control form-control-sm" {{ $disabled }} type="number" name="{{ $key }}" id="unit-{{ $key }}" size="5" min="0" max="99999" step="1" >
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td class="border-bottom-0" ></td>
                                                            <td class="border-bottom-0" ></td>
                                                            <td class="border-bottom-0 d-none d-sm-table-cell text-center" ></td>
                                                            <td class="border-bottom-0" >
                                                                <div class="row mx-auto">
                                                                    <div class="col-12 px-0">
                                                                        <a class="btn btn-success w-100 btn-sm float-end"
                                                                            {{-- TODO descomentar --}}
                                                                            {{-- onclick="event.preventDefault(); document.getElementById( 'form-units' ).submit();" --}}
                                                                            href="#" >
                                                                            Recrutar
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            @else
                                @if ( !empty( $buildings[ "stable" ][ "required" ] ) )
                                    @include( "users/player/partials.building-require", [ "name" => $buildings[ "stable" ][ "key" ] ] )
                                @endif
                            @endif

                            {{-- unidades ainda nao pesquisadas --}}
                            @if( !empty( $unitsOff ) )
                                <div class="col-12 col-xl-9 mx-auto mt-5" >
                                    <div class="table-responsive" >
                                        <table id="not-build" class="table table-hover table-sm align-middle mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>Ainda não disponível</th>
                                                    <th>Requerimentos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ( $unitsOff as $key => $unit )
                                                    <tr>
                                                        <td @if ( $loop->last ) class="border-bottom-0" @endif >
                                                            <div class="row mx-auto" >
                                                                <div class="col-12 col-lg-5 text-center ps-lg-0 m-auto" >
                                                                    <img src="{{ asset( "assets/graphic/units/icons/{$key}.png" ) }}" alt="{{ $unit[ "name" ] }}" style="filter: grayscale(100%);" >
                                                                </div>
                                                                <div class="col-12 col-lg-7 text-center text-lg-start ps-lg-0 m-auto" >
                                                                    <p class="mb-0" >
                                                                        {{ $unit[ "name" ] }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center @if ( $loop->last ) border-bottom-0 @endif" >
                                                            @php
                                                                $allEnab = [];
                                                            @endphp
                                                            @foreach ( $unit[ "required" ] as $building => $level )
                                                                @php
                                                                    $disabled = "";

                                                                    if ( $village->{ "building_{$building}" } < $level )
                                                                    {
                                                                        $disabled  = "disabled";
                                                                        $allEnab[] = false;
                                                                    }

                                                                    $png      = Helper::getLevelImage( $building, $level );
                                                                    $img      = "{$building}{$png}.png";
                                                                @endphp
                                                                <button class="btn btn-link btn-sm text-decoration-none text-dark float-sm-start cursor-none {{ $disabled }}" >
                                                                    <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="{{ $buildings[ $building ][ "name" ] }}" >
                                                                    {{ $buildings[ $building ][ "name" ] }} - Nível {{ $level }}
                                                                </button>
                                                            @endforeach
                                                            @if ( empty( $allEnab ) )
                                                                <div class="py-2 text-center float-sm-end" >
                                                                    <a class="btn btn-primary btn-sm" href="{{ route( "village.smithy", [ "village" => $village ] ) }}" >
                                                                        Pesquisar
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
