@extends( "layouts.game" )

@section( "title", $buildings[ "hide" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }}</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "hide" ] ] )

                        {{-- edificios construidos --}}
                        <div class="table-responsive d-none" >
                            <table id="builded" class="table table-hover table-sm align-middle mb-0" >
                                <thead>
                                    <tr>
                                        <th>Edifícios</th>
                                        <th>Requerimentos</th>
                                        <th>Construir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $buildings as $id => $building )
                                        @if ( empty( $building[ "required" ] ) )
                                            <tr>
                                                <td>
                                                    <div class="row" >
                                                        <div class="col-3 text-center m-auto" >
                                                            <img src="{{ asset( "assets/graphic/buildings/{$id}1.png" ) }}" alt="" >
                                                        </div>
                                                        <div class="col-9 ps-0" >
                                                            <p class="h5 mb-0" >
                                                                {{ $building[ "name" ] }}
                                                                <br>
                                                                <span class="text-muted" >
                                                                    @if ( $building[ "level" ] == 0 )
                                                                        Não construído
                                                                    @else
                                                                        Nível {{ $building[ "level" ] }}
                                                                    @endif
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row" >
                                                        <div class="col-2 @if( $building[ "wood" ] > 100 ) text-danger @endif" title="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                            <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "wood" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "wood" ][ "name" ] }}" >
                                                            {{ $building[ "wood"       ] }}
                                                        </div>
                                                        <div class="col-2 @if( $building[ "clay" ] > 100 ) text-danger @endif" title="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                            <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "clay" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "clay" ][ "name" ] }}" >
                                                            {{ $building[ "clay"       ] }}
                                                        </div>
                                                        <div class="col-2 @if( $building[ "iron" ] > 100 ) text-danger @endif" title="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                            <img src="{{ asset( "assets/graphic/buildings/icons/{$buildings[ "iron" ][ "key" ]}.png" ) }}" alt="{{ $buildings[ "iron" ][ "name" ] }}" >
                                                            {{ $building[ "iron"       ] }}
                                                        </div>
                                                        <div class="col-2 @if( $building[ "pop"  ] > 100 ) text-danger @endif" title="Tempo" >
                                                            <img src="{{ asset( "assets/graphic/buildings/icons/time.png" ) }}" alt="Tempo" >
                                                            {{ $building[ "pop"        ] }}
                                                        </div>
                                                        <div class="col-2" title="População" >
                                                            <img src="{{ asset( "assets/graphic/buildings/icons/pop.png" ) }}" alt="População" >
                                                            {{ $building[ "build_time" ] }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
                                                        $class    = "success";
                                                        $disabled = "";

                                                        if ( $building[ "wood" ] > 100 || $building[ "clay" ] > 100 || $building[ "wood" ] > 100 )
                                                        {
                                                            $class    = "secondary";
                                                            $disabled = "disabled";
                                                        }
                                                    @endphp
                                                    <button class="btn btn-{{ $class }} btn-sm w-100" {{ $disabled }}>
                                                        Nível {{ $building[ "level" ] + 1 }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- edificios ainda nao construidos --}}
                        <div class="table-responsive d-none" >
                            <table id="not-build" class="table table-hover table-sm align-middle mt-5 mb-0" >
                                <thead>
                                    <tr>
                                        <th>Ainda não disponível</th>
                                        <th>Requerimentos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $buildings as $id => $building )
                                        @if ( !empty( $building[ "required" ] ) )
                                            <tr>
                                                <td>
                                                    <div class="row" >
                                                        <div class="col-4 text-center m-auto" >
                                                            <img src="{{ asset( "assets/graphic/buildings/{$id}1.png" ) }}" alt="{{ $building[ "name" ] }}" >
                                                        </div>
                                                        <div class="col-8 ps-0 m-auto" >
                                                            <p class="h5 mb-0" >
                                                                {{ $building[ "name" ] }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @foreach ( $building[ "required" ] as $name => $level )
                                                        <button class="btn btn-link btn-sm disabled m-auto text-decoration-none" >
                                                            <img src="{{ asset( "assets/graphic/buildings/{$name}1.png" ) }}" alt="{{ $buildings[ $name ][ "name" ] }}" >
                                                            {{ $buildings[ $name ][ "name" ] }} - Nível {{ $level }}
                                                        </button>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
