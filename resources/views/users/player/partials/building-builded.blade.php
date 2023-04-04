    <div class="col-12 col-xl-9 mx-auto" >
        <div class="table-responsive" >
            <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                <thead>
                    <tr>
                        <th>Edifícios</th>
                        <th>Requerimentos</th>
                        <th>Construir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $village->buildings->on as $key => $building )
                        <tr>
                            <td class="@if ( $loop->last ) border-bottom-0 @endif" >
                                <div class="row mx-auto" >
                                    <div class="col-12 col-lg-4 text-center ps-lg-0 m-auto" >
                                        @php
                                            $png = Helper::getLevelImage( $key, $building->level );
                                            $img = "{$key}{$png}.png";
                                        @endphp
                                        <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="" >
                                    </div>
                                    <div class="col-12 col-lg-8 text-center text-lg-start ps-lg-0 m-auto" >
                                        <a class="text-decoration-none text-dark" href="{{ route( "village.{$key}", [ "village" => $village->id ] ) }}" >
                                            <p class="mb-0" >
                                                {{ $building->name }}
                                                <br>
                                                <span class="text-muted" >
                                                    @if ( $building->level == 0 )
                                                        Não construído
                                                    @else
                                                        Nível {{ $building->level }}
                                                    @endif
                                                </span>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </td>

                            @if ( $building->level < $building->max_level )
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

                                    if ( $building->wood > $village->stored_wood )
                                    {
                                        $class_wood = "text-danger";
                                        $lack_wood  = true;
                                    }

                                    if ( $building->clay > $village->stored_clay )
                                    {
                                        $class_clay = "text-danger";
                                        $lack_clay  = true;
                                    }

                                    if ( $building->iron > $village->stored_iron )
                                    {
                                        $class_iron = "text-danger";
                                        $lack_iron  = true;
                                    }

                                    $free_pop = $village->buildings->on->farm->max_pop - $village->pop;

                                    if ( ( $free_pop < 0 || $building->pop > $free_pop ) && $building->pop != 0 )
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
                                <td class="@if ( $loop->last ) border-bottom-0 @endif" >
                                    <div class="row mx-auto" >
                                        <div class="px-1 col-12 col-sm-4 col-lg-2 {{ $class_wood }}" title="{{ $buildings[ "wood" ][ "name" ] }}" >
                                            <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wood" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "wood" ][ "name" ] }}" >
                                            {{ ( int ) $building->wood }}
                                        </div>
                                        <div class="px-1 col-12 col-sm-4 col-lg-2 {{ $class_clay }}" title="{{ $buildings[ "clay" ][ "name" ] }}" >
                                            <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "clay" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "clay" ][ "name" ] }}" >
                                            {{ ( int ) $building->clay }}
                                        </div>
                                        <div class="px-1 col-12 col-sm-4 col-lg-2 {{ $class_iron }}" title="{{ $buildings[ "iron" ][ "name" ] }}" >
                                            <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                                            {{ ( int ) $building->iron }}
                                        </div>
                                        <div class="px-1 col-12 col-sm-4 col-lg-2 {{ $class_pop }}" title="População" >
                                            <img src="{{ asset( "assets/graphic/buildings/icons/pop.png" ) }}" alt="População" >
                                            {{ ( int ) $building->pop  }}
                                        </div>
                                        <div class="px-1 col-12 col-sm-8 col-lg-4" title="Tempo" >
                                            <img src="{{ asset( "assets/graphic/buildings/icons/time.png" ) }}" alt="Tempo" >
                                            {{ Helper::formatBuildTime( ( int ) $building->build_time ) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="@if ( $loop->last ) border-bottom-0 @endif" >
                                    <a class="btn btn-{{ $class }} btn-sm w-100 {{ $disabled }}" {{ $disabled }}
                                        onclick="event.preventDefault(); document.getElementById( 'form-{{ $key }}' ).submit();"
                                        href="{{ route( "village.upgrade.building", [ "village" => $village, "building" => $key ] ) }}" >
                                        Nível {{ $building->level + 1 + Helper::searchBuildingInEvents( $key, $events->toArray() ) }}
                                    </a>
                                    <form id="form-{{ $key }}" method="POST" class="d-none" action="{{ route( "village.upgrade.building", [ "village" => $village, "building" => $key ] ) }}" >
                                        @csrf
                                        <input type="hidden" name="wood" value="{{ $building->wood }}" >
                                        <input type="hidden" name="clay" value="{{ $building->clay }}" >
                                        <input type="hidden" name="iron" value="{{ $building->iron }}" >
                                        <input type="hidden" name="pop"  value="{{ $building->pop  }}" >
                                    </form>
                                </td>
                            @else
                                <td class="text-center text-muted @if ( $loop->last ) border-bottom-0 @endif" >
                                    Totalmente construído
                                </td>
                                <td class="@if ( $loop->last ) border-bottom-0 @endif" ></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
