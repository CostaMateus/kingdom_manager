@extends( "layouts.game" )

@section( "title", $buildings[ "smithy" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "smithy" ] ] )

                        @if ( $village->building_smithy > 0 )
                            @php
                                $auxs[ "infantry" ][ "spear"    ] = ( isset( $unitsOn[ "spear"    ] ) ) ? $unitsOn[ "spear"    ] : $unitsOff[ "spear"    ];
                                $auxs[ "infantry" ][ "sword"    ] = ( isset( $unitsOn[ "sword"    ] ) ) ? $unitsOn[ "sword"    ] : $unitsOff[ "sword"    ];
                                $auxs[ "infantry" ][ "axe"      ] = ( isset( $unitsOn[ "axe"      ] ) ) ? $unitsOn[ "axe"      ] : $unitsOff[ "axe"      ];
                                $auxs[ "infantry" ][ "archer"   ] = ( isset( $unitsOn[ "archer"   ] ) ) ? $unitsOn[ "archer"   ] : $unitsOff[ "archer"   ];

                                $auxs[ "cavalry"  ][ "spy"      ] = ( isset( $unitsOn[ "spy"      ] ) ) ? $unitsOn[ "spy"      ] : $unitsOff[ "spy"      ];
                                $auxs[ "cavalry"  ][ "light"    ] = ( isset( $unitsOn[ "light"    ] ) ) ? $unitsOn[ "light"    ] : $unitsOff[ "light"    ];
                                $auxs[ "cavalry"  ][ "marcher"  ] = ( isset( $unitsOn[ "marcher"  ] ) ) ? $unitsOn[ "marcher"  ] : $unitsOff[ "marcher"  ];
                                $auxs[ "cavalry"  ][ "heavy"    ] = ( isset( $unitsOn[ "heavy"    ] ) ) ? $unitsOn[ "heavy"    ] : $unitsOff[ "heavy"    ];

                                $auxs[ "siege"    ][ "ram"      ] = ( isset( $unitsOn[ "ram"      ] ) ) ? $unitsOn[ "ram"      ] : $unitsOff[ "ram"      ];
                                $auxs[ "siege"    ][ "catapult" ] = ( isset( $unitsOn[ "catapult" ] ) ) ? $unitsOn[ "catapult" ] : $unitsOff[ "catapult" ];
                            @endphp

                            <div class="row mt-5" >
                                @foreach ( $auxs as $type => $auxUnits )
                                    <div class="col-12 col-md-4" >
                                        @if ( !$loop->first && !$loop->last )
                                            <hr class="my-5 d-md-none" >
                                        @endif
                                        <div class="row" >
                                            <div class="col-12 text-center" >
                                                <h4 class="fw-bold" >
                                                    @if ( $type == "infantry" )
                                                        Infantaria
                                                    @elseif ( $type == "cavalry" )
                                                        Cavalaria
                                                    @else
                                                        Armas de cerco
                                                    @endif
                                                </h4>
                                            </div>
                                            @foreach ( $auxUnits as $key => $auxUnit )
                                                @php
                                                    $level      = $village->{ "research_{$key}" };

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

                                                    if ( $auxUnit[ "wood" ] > $village->stored_wood )
                                                    {
                                                        $class_wood = "text-danger";
                                                        $lack_wood  = true;
                                                    }

                                                    if ( $auxUnit[ "clay" ] > $village->stored_clay )
                                                    {
                                                        $class_clay = "text-danger";
                                                        $lack_clay  = true;
                                                    }

                                                    if ( $auxUnit[ "iron" ] > $village->stored_iron )
                                                    {
                                                        $class_iron = "text-danger";
                                                        $lack_iron  = true;
                                                    }
                                                @endphp
                                                <div class="col-12 @if ( !$loop->first ) mt-5 @endif" >
                                                    <div class="row mx-auto" >
                                                        <div class="col-12 col-lg-5 text-center ps-lg-0 m-auto" @if ( $level == 0 ) style="filter: grayscale(100%);" @endif >
                                                            <img src="{{ asset( "assets/graphic/units/icons/{$key}.png" ) }}" alt="{{ $auxUnit[ "name" ] }}" >
                                                        </div>
                                                        <div class="col-12 col-lg-7 text-center text-lg-start ps-lg-0 m-auto" >
                                                            <p class="mb-0 fs-5" >{{ $auxUnit[ "name" ] }}</p>

                                                            @if ( $level < 3 )
                                                                @if ( $level == 0 )
                                                                    <p class="text-danger" >Não pesquisado</p>
                                                                @else
                                                                    <p>Nível {{ $level }}</p>
                                                                @endif

                                                                <div class="" >
                                                                    <div class="px-1 col-12 {{ $class_wood }}" title="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                                        <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wood" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                                        {{ ( int ) $auxUnit[ "research_wood" ] }}
                                                                    </div>
                                                                    <div class="px-1 col-12 {{ $class_clay }}" title="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                                        <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "clay" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                                        {{ ( int ) $auxUnit[ "research_clay" ] }}
                                                                    </div>
                                                                    <div class="px-1 col-12 {{ $class_iron }}" title="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                                        <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                                        {{ ( int ) $auxUnit[ "research_iron" ] }}
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <p class="mb-0 text-success" >Pesquisado</p>
                                                                <p class="mb-0" >Nível {{ $level }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @if ( $level < 3 )
                                                        <div class="row mt-2" >
                                                            <div class="col-12 text-center" >
                                                                <a class="btn btn-{{ $class }} btn-sm {{ $disabled }}" {{ $disabled }}
                                                                    onclick="event.preventDefault(); document.getElementById( 'form-{{ $key }}' ).submit();"
                                                                    href="{{ route( "village.research.unit", [ "village" => $village, "unit" => $key ] ) }}" >
                                                                    Pesquisar nível {{ $level + 1 }}
                                                                </a>
                                                                <form id="form-{{ $key }}" method="POST" class="d-none"
                                                                    action="{{ route( "village.research.unit", [ "village" => $village, "unit" => $key ] ) }}" >
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ( !$loop->first && !$loop->last )
                                            <hr class="my-5 d-md-none" >
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- requisitos da forja --}}
                            <div class="col-12 col-xl-9 mx-auto mt-5" >
                                <div class="table-responsive" >
                                    <table id="not-build" class="table table-hover table-sm align-middle mb-0" >
                                        <thead>
                                            <tr>
                                                <th>Requerimentos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ( $smithy = isset( $buildingsOn[ "smithy" ] ) ? $buildingsOn[ "smithy" ] : $buildingsOff[ "smithy" ] )
                                                @foreach ( $smithy[ "required" ] as $key => $level )
                                                    <tr>
                                                        <td class="@if ( $loop->last ) border-bottom-0 @endif" >
                                                            @php
                                                                $disabled = ( $village->{ "building_{$key}" } < $level ) ? "disabled" : "";
                                                                $png      = Helper::getLevelImage( $key, $level );
                                                                $img      = "{$key}{$png}.png";
                                                            @endphp
                                                            <button class="btn btn-link btn-sm m-auto text-decoration-none text-dark cursor-none {{ $disabled }}" >
                                                                <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="{{ $buildings[ $key ][ "name" ] }}" >
                                                                {{ $buildings[ $key ][ "name" ] }} - Nível {{ $level }}
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
@endsection

@include( "users/player/partials.update-resources" )
