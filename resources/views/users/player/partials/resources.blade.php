            @php
                $text_wood   = ( $village->stored_wood >= ( 0.9 * $village->buildings->on->warehouse->capacity ) ) ? "text-danger" : "";
                $text_clay   = ( $village->stored_clay >= ( 0.9 * $village->buildings->on->warehouse->capacity ) ) ? "text-danger" : "";
                $text_iron   = ( $village->stored_iron >= ( 0.9 * $village->buildings->on->warehouse->capacity ) ) ? "text-danger" : "";
                $text_farm   = ( $village->pop         >= ( 0.9 * $village->buildings->on->farm->max_pop       ) ) ? "text-danger" : "";

                $active_wood = Route::currentRouteNamed( "village.wood"      ) ? "active" : "";
                $active_clay = Route::currentRouteNamed( "village.clay"      ) ? "active" : "";
                $active_iron = Route::currentRouteNamed( "village.iron"      ) ? "active" : "";
                $active_farm = Route::currentRouteNamed( "village.farm"      ) ? "active" : "";
                $active_wh   = Route::currentRouteNamed( "village.warehouse" ) ? "active" : "";

                $class_wood  = "{$text_wood} {$active_wood}";
                $class_clay  = "{$text_clay} {$active_clay}";
                $class_iron  = "{$text_iron} {$active_iron}";
                $class_farm  = "{$text_farm} {$active_farm}";
                $class_wh    = $active_wh;

                $route_wood  = route( "village.wood",      [ "village" => $village ] );
                $route_clay  = route( "village.clay",      [ "village" => $village ] );
                $route_iron  = route( "village.iron",      [ "village" => $village ] );
                $route_farm  = route( "village.farm",      [ "village" => $village ] );
                $route_wh    = route( "village.warehouse", [ "village" => $village ] );

                $title_wood  = $buildings->wood->name;
                $title_clay  = $buildings->clay->name;
                $title_iron  = $buildings->iron->name;
                $title_farm  = $buildings->farm->name;
                $title_wh    = $buildings->warehouse->name;

                $compl_wood  = $title_wood . ": " . number_format( $village->prod_wood, 0, ",", "." ) . "/h";
                $compl_clay  = $title_clay . ": " . number_format( $village->prod_clay, 0, ",", "." ) . "/h";
                $compl_iron  = $title_iron . ": " . number_format( $village->prod_iron, 0, ",", "." ) . "/h";
            @endphp

            <div class="col-12 col-md-10 mx-auto" >
                <div class="btn-group btn-group-sm pb-2" role="group" aria-label="Button group with nested dropdown" >
                    <button type="button" class="btn btn-light btn-km dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" >
                        {{ $village->name }}
                    </button>
                    <ul class="dropdown-menu" >
                        @foreach ( $villages as $v )
                            <li><a class="dropdown-item bg-km" href="{{ route( "village.overview", [ "village" => $v ] ) }}" >{{ $v->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="float-end mx-auto text-center" >
                    <div class="btn-group btn-group-sm btn-group-km pb-2 order-1" role="group" >
                        {{-- wood --}}
                        <a id="stored_wood" class="btn btn-light btn-km btn-sm {{ $class_wood }}" href="{{ $route_wood }}" title="{{ $compl_wood }}" >
                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings->wood->key}.png" ) }}" alt="{{ $title_wood }}" >
                            <span>{{ ( int ) $village->stored_wood }}</span>
                        </a>

                        {{-- clay --}}
                        <a id="stored_clay" class="btn btn-light btn-km btn-sm {{ $class_clay }}" href="{{ $route_clay }}" title="{{ $compl_clay }}" >
                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings->clay->key}.png" ) }}" alt="{{ $title_clay }}" >
                            <span>{{ ( int ) $village->stored_clay }}</span>
                        </a>

                        {{-- iron --}}
                        <a id="stored_iron" class="btn btn-light btn-km btn-sm {{ $class_iron }}" href="{{ $route_iron }}" title="{{ $compl_iron }}" >
                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings->iron->key}.png" ) }}" alt="{{ $title_iron }}" >
                            <span>{{ ( int ) $village->stored_iron }}</span>
                        </a>
                    </div>
                    <div class="btn-group btn-group-sm btn-group-km pb-2 order-2" role="group" >
                        {{-- warehouse --}}
                        <a class="btn btn-light btn-km btn-sm {{ $class_wh }}" href="{{ $route_wh }}" title="{{ $title_wh }}" >
                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings->warehouse->key}.png" ) }}" alt="{{ $title_wh }}" >
                            {{ ( int ) $village->buildings->on->warehouse->capacity }}
                        </a>

                        {{-- pop --}}
                        <a class="btn btn-light btn-km btn-sm {{ $class_farm }}" href="{{ $route_farm }}" title="{{ $title_farm }}" >
                            <img width="15" src="{{ asset( "assets/graphic/buildings/icons/pop.png" ) }}" alt="{{ $title_farm }}" >
                            {{ $village->pop }}/{{ ( int ) $village->buildings->on->farm->max_pop }}
                        </a>
                    </div>
                    <div class="btn-group btn-group-sm btn-group-km pb-2 order-3" role="group" >
                        {{-- ataque chegando --}}
                        {{-- esconder qnd não tiver ataques chegando --}}
                        <a class="btn btn-light btn-km btn-sm" href="#" title="Ataque chegando" >
                            <img width="15" src="{{ asset( "assets/graphic/attack/att.png" ) }}" alt="Ataque chegando" >
                            4
                        </a>

                        {{-- apoio chegando --}}
                        {{-- esconder qnd não tiver ataques chegando --}}
                        <a class="btn btn-light btn-km btn-sm" href="#" title="Apoio chegando" >
                            <img width="15" src="{{ asset( "assets/graphic/attack/def.png" ) }}" alt="Apoio chegando" >
                            6
                        </a>
                    </div>
                </div>
            </div>
