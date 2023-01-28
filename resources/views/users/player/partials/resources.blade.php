            <div class="col-12" >
                <div class="btn-group btn-group-sm pb-2" role="group" aria-label="Button group with nested dropdown" >
                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        {{ $village->name }}
                    </button>
                    <ul class="dropdown-menu" >
                        @foreach ( $villages as $v )
                            <li><a class="dropdown-item" href="{{ route( "village.overview", [ "village" => $v ] ) }}" >{{ $v->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="btn-group btn-group-sm float-end pb-2" role="group" aria-label="Resources" >
                    @php
                        $class_wood = ( $village->stored_wood >= ( 0.9 * $buildingsOn[ "warehouse" ][ "capacity" ] ) ) ? "text-danger" : "";
                        $class_clay = ( $village->stored_clay >= ( 0.9 * $buildingsOn[ "warehouse" ][ "capacity" ] ) ) ? "text-danger" : "";
                        $class_iron = ( $village->stored_iron >= ( 0.9 * $buildingsOn[ "warehouse" ][ "capacity" ] ) ) ? "text-danger" : "";
                        $class_pop  = ( $village->pop         >= ( 0.9 * $buildingsOn[ "farm"      ][ "max_pop"  ] ) ) ? "text-danger" : "";
                    @endphp

                    {{-- wood --}}
                    <a id="stored_wood" class="btn btn-light {{ $class_wood }}" href="{{ route( "village.wood",      [ "village" => $village ] ) }}" title="{{ $buildings[ "wood" ][ "name" ] }}: {{ ( int ) ( $village->prod_wood * config( "game.speed" ) ) }}/min" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wood"      ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "wood" ][ "name" ] }}" >
                        <span>{{ $village->stored_wood }}</span>
                    </a>

                    {{-- clay --}}
                    <a id="stored_clay" class="btn btn-light {{ $class_clay }}" href="{{ route( "village.clay",      [ "village" => $village ] ) }}" title="{{ $buildings[ "clay" ][ "name" ] }}: {{ ( int ) ( $village->prod_clay * config( "game.speed" ) ) }}/min" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "clay"      ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "clay" ][ "name" ] }}" >
                        <span>{{ $village->stored_clay }}</span>
                    </a>

                    {{-- iron --}}
                    <a id="stored_iron" class="btn btn-light {{ $class_iron }}" href="{{ route( "village.iron",      [ "village" => $village ] ) }}" title="{{ $buildings[ "iron" ][ "name" ] }}: {{ ( int ) ( $village->prod_iron * config( "game.speed" ) ) }}/min" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron"      ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                        <span>{{ $village->stored_iron }}</span>
                    </a>

                    {{-- warehouse --}}
                    <a                  class="btn btn-light"                   href="{{ route( "village.warehouse", [ "village" => $village ] ) }}" title="{{ $buildings[ "warehouse" ][ "name" ] }}" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "warehouse" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "warehouse" ][ "name" ] }}" >
                        {{ ( int ) $buildingsOn[ "warehouse" ][ "capacity" ] }}
                    </a>

                    {{-- pop --}}
                    <a                  class="btn btn-light {{ $class_pop  }}" href="{{ route( "village.farm",      [ "village" => $village ] ) }}" title="{{ $buildings[ "farm" ][ "name" ] }}" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "farm"      ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "farm" ][ "name" ] }}" >
                        {{ $village->pop }}/{{ ( int ) $buildingsOn[ "farm" ][ "max_pop" ] }}
                    </a>
                </div>
            </div>
