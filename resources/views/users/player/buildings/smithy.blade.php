@extends( "layouts.game" )

@section( "title", $buildings[ "smithy" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    {{-- nome e pontuação da aldeia --}}
                    @include( "users/player/partials.building-name" )

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [
                            "title"    => "Tempo reduzido por nível",
                            "field"    => "time",
                            "uni"      => "%",
                            "building" => $buildings[ "smithy" ]
                        ] )

                        <div class="row mt-4" >

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
                                                @foreach ( $auxUnits as $keyUnit => $auxUnit )
                                                    @php
                                                        $levelUnit  = $village->{ "research_{$keyUnit}" };

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

                                                        if ( $auxUnit[ "research_wood" ] > $village->stored_wood )
                                                        {
                                                            $class_wood = "text-danger";
                                                            $lack_wood  = true;
                                                        }

                                                        if ( $auxUnit[ "research_clay" ] > $village->stored_clay )
                                                        {
                                                            $class_clay = "text-danger";
                                                            $lack_clay  = true;
                                                        }

                                                        if ( $auxUnit[ "research_iron" ] > $village->stored_iron )
                                                        {
                                                            $class_iron = "text-danger";
                                                            $lack_iron  = true;
                                                        }
                                                    @endphp
                                                    <div class="col-12 @if ( !$loop->first ) mt-5 @endif" >
                                                        <div class="row mx-auto" >
                                                            <div class="col-12 col-lg-5 text-center ps-lg-0 m-auto" @if ( $levelUnit == 0 ) style="filter: grayscale(100%);" @endif >
                                                                <img src="{{ asset( "assets/graphic/units/icons/{$keyUnit}.png" ) }}" alt="{{ $auxUnit[ "name" ] }}" >
                                                            </div>
                                                            <div class="col-12 col-lg-7 text-center text-lg-start ps-lg-0 m-auto" >
                                                                <p class="mb-0 fs-5" >{{ $auxUnit[ "name" ] }}</p>

                                                                @if ( $levelUnit < 3 )
                                                                    @if ( $levelUnit == 0 )
                                                                        <p class="text-danger" >Não pesquisado</p>
                                                                    @else
                                                                        <p>Nível {{ $levelUnit }}</p>
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
                                                                    <p class="mb-0" >Nível {{ $levelUnit }}</p>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        @if ( $levelUnit < 3 )
                                                            @php
                                                                $available = true;

                                                                if ( !empty( $auxUnit[ "required" ] ) )
                                                                {
                                                                    $builded = [];

                                                                    foreach ( $auxUnit[ "required" ] as $key => $level )
                                                                        $builded[] = ( $village->{"building_{$key}"} >= $level ) ? true : false;

                                                                    $available = ( in_array( false, $builded ) ) ? false : true;
                                                                }
                                                            @endphp

                                                            @if ( $available )
                                                                <div class="row mt-2" >
                                                                    <div class="col-12 text-center" >
                                                                        <a class="btn btn-{{ $class }} btn-sm {{ $disabled }}" {{ $disabled }}
                                                                            onclick="event.preventDefault(); document.getElementById( 'form-{{ $keyUnit }}' ).submit();"
                                                                            href="{{ route( "village.research.unit", [ "village" => $village, "unit" => $keyUnit ] ) }}" >
                                                                            Pesquisar nível {{ $levelUnit + 1 }}
                                                                        </a>
                                                                        <form id="form-{{ $keyUnit }}" method="POST" class="d-none"
                                                                            action="{{ route( "village.research.unit", [ "village" => $village, "unit" => $keyUnit ] ) }}" >
                                                                            @csrf
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            @endif
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
                                @include( "users/player/partials.building-require", [ "name" => $buildings[ "smithy" ][ "key" ] ] )
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
