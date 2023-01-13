@extends( "layouts.game" )

@section( "title", $buildings[ "main" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }}</div>

                    <div class="card-body" >
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "main" ] ] )

                        <div class="row" >

                            {{-- edificios construidos --}}
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
                                            @foreach ( $buildingsOn as $key => $building )
                                                <tr>
                                                    <td>
                                                        <div class="row mx-auto" >
                                                            <div class="col-12 col-lg-4 text-center ps-lg-0 m-auto" >
                                                                <img src="{{ asset( "assets/graphic/buildings/{$key}1.png" ) }}" alt="" >
                                                            </div>
                                                            <div class="col-12 col-lg-8 text-center text-lg-start ps-lg-0 m-auto" >
                                                                <a class="text-decoration-none text-dark" href="{{ route( "village.{$key}", [ "village" => $village ] ) }}" >
                                                                    <p class="mb-0" >
                                                                        {{ $building[ "name" ] }}
                                                                        <br>
                                                                        <span class="text-muted" >
                                                                            @if ( $village->{ "building_{$key}" } == 0 )
                                                                                Não construído
                                                                            @else
                                                                                Nível {{ $village->{ "building_{$key}" } }}
                                                                            @endif
                                                                        </span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    @if ( $village->{ "building_{$key}" } < $building[ "max_level" ] )
                                                        <td>
                                                            <div class="row mx-auto" >
                                                                <div class="px-1 col-12 col-sm-4 col-lg-2" title="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                                    <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wood" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                                    {{ $building[ "wood"       ] }}
                                                                </div>
                                                                <div class="px-1 col-12 col-sm-4 col-lg-2" title="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                                    <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "clay" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                                    {{ $building[ "clay"       ] }}
                                                                </div>
                                                                <div class="px-1 col-12 col-sm-4 col-lg-2" title="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                                    <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                                    {{ $building[ "iron"       ] }}
                                                                </div>
                                                                <div class="px-1 col-12 col-sm-4 col-lg-2" title="População" >
                                                                    <img src="{{ asset( "assets/graphic/buildings/icons/pop.png" ) }}" alt="População" >
                                                                    {{ $building[ "pop"        ] }}
                                                                </div>
                                                                <div class="px-1 col-12 col-sm-8 col-lg-4" title="Tempo" >
                                                                    <img src="{{ asset( "assets/graphic/buildings/icons/time.png" ) }}" alt="Tempo" >
                                                                    {{ $building[ "build_time" ] }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $class    = "success";
                                                                $disabled = "";

                                                                // if ( $building[ "wood" ] > 100 || $building[ "clay" ] > 100 || $building[ "wood" ] > 100 )
                                                                // {
                                                                //     $class    = "secondary";
                                                                //     $disabled = "disabled";
                                                                // }
                                                            @endphp

                                                            <a class="btn btn-{{ $class }} btn-sm w-100" {{ $disabled }}
                                                                onclick="event.preventDefault(); document.getElementById( 'form-{{ $key }}' ).submit();"
                                                                href="{{ route( "village.upgrade.building", [ "village" => $village, "building" => $key ] ) }}" >
                                                                Nível {{ $village->{ "building_{$key}" } + 1 }}
                                                            </a>
                                                            <form id="form-{{ $key }}"
                                                                method="POST"
                                                                class="d-none"
                                                                action="{{ route( "village.upgrade.building", [ "village" => $village, "building" => $key ] ) }}" >
                                                                @csrf
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td class="text-center text-muted" >Totalmente construído</td>
                                                        <td></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- edificios ainda nao construidos --}}
                            @if( !empty( $buildingsOff ) )
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
                                                @foreach ( $buildingsOff as $key => $building )
                                                    <tr>
                                                        <td>
                                                            <div class="row mx-auto" >
                                                                <div class="col-12 col-lg-5 text-center ps-lg-0 m-auto" >
                                                                    <img src="{{ asset( "assets/graphic/buildings/{$key}1.png" ) }}" alt="{{ $building[ "name" ] }}" >
                                                                </div>
                                                                <div class="col-12 col-lg-7 text-center text-lg-start ps-lg-0 m-auto" >
                                                                    <p class="mb-0" >
                                                                        {{ $building[ "name" ] }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @foreach ( $building[ "required" ] as $key2 => $level )
                                                                @php
                                                                    $disabled = ( $village->{ "building_{$key2}" } < $level ) ? "disabled" : "";
                                                                @endphp
                                                                <button class="btn btn-link btn-sm m-auto text-decoration-none text-dark cursor-none {{ $disabled }}" >
                                                                    <img src="{{ asset( "assets/graphic/buildings/{$key2}1.png" ) }}" alt="{{ $buildings[ $key2 ][ "name" ] }}" >
                                                                    {{ $buildings[ $key2 ][ "name" ] }} - Nível {{ $level }}
                                                                </button>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            {{-- nome da aldeia --}}
                            <div class="col-12 col-xl-9 mx-auto mt-5" >
                                <p class="fw-bold mb-2" >Mudar nome da aldeia:</p>
                                <form class="row row-cols-auto" method="POST" action="{{ route( "village.change.name", [ "village" => $village ] ) }}" >
                                    @csrf
                                    <div class="col pe-2" >
                                        <input type="text" class="form-control form-control-sm" name="name" value="{{ $village->name }}" >
                                    </div>
                                    <div class="col ps-2" >
                                        <button type="submit" class="btn btn-light btn-sm" >Salvar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
