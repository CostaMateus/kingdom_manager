@extends( "layouts.game" )

@section( "title", $buildings[ "market" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [
                            "title"    => "Capacidade por nível",
                            "field"    => "merchants",
                            "uni"      => "",
                            "building" => $buildings[ "market" ]
                        ] )

                        {{-- TODO --}}
                        {{-- não implementado --}}
                        @include( "users/player/partials.warning", [ "warning_text" => "Recurso não implementado! Status 0%" ] )

                        <div class="row mt-4" >

                            @if ( $village->building_market > 0 )
                                {{--  --}}
                            @else
                                @if ( !empty( $buildings[ "market" ][ "required" ] ) )
                                    @include( "users/player/partials.building-require", [ "name" => $buildings[ "market" ][ "key" ] ] )
                                @endif
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
