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
                    <a class="btn btn-light" href="{{  route( "village.wood", [ "village" => $village ] ) }}" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wood" ][ "key" ]}.png" ) }}"
                            title="{{ $buildings[ "wood" ][ "name" ] }}" alt="{{ $buildings[ "wood" ][ "name" ] }}" >
                        {{ $village->cap_wood }}
                    </a>
                    <a class="btn btn-light" href="{{  route( "village.clay", [ "village" => $village ] ) }}" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "clay" ][ "key" ]}.png" ) }}"
                            title="{{ $buildings[ "clay" ][ "name" ] }}" alt="{{ $buildings[ "clay" ][ "name" ] }}" >
                        {{ $village->cap_clay }}
                    </a>
                    <a class="btn btn-light" href="{{  route( "village.iron", [ "village" => $village ] ) }}" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron" ][ "key" ]}.png" ) }}"
                            title="{{ $buildings[ "iron" ][ "name" ] }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                        {{ $village->cap_iron }}
                    </a>
                    <a class="btn btn-light" href="{{  route( "village.farm", [ "village" => $village ] ) }}" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "farm" ][ "key" ]}.png" ) }}"
                            title="{{ $buildings[ "farm" ][ "name" ] }}" alt="{{ $buildings[ "farm" ][ "name" ] }}" >
                        {{ $buildings[ "warehouse" ][ "capacity" ] }}
                    </a>
                    <a class="btn btn-light" href="{{  route( "village.warehouse", [ "village" => $village ] ) }}" >
                        <img width="15" src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "warehouse" ][ "key" ]}.png" ) }}"
                            title="{{ $buildings[ "warehouse" ][ "name" ] }}" alt="{{ $buildings[ "warehouse" ][ "name" ] }}" >
                        0/{{ $buildings[ "farm" ][ "max_pop" ] }}
                    </a>
                </div>
            </div>
