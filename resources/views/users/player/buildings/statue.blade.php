@extends( "layouts.game" )

@section( "title", $buildings[ "statue" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-10 mx-auto" >
                <div class="card border-0" >
                    {{-- nome e pontuação da aldeia --}}
                    @include( "users/player/partials.building-name" )

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [
                            "title"    => null,
                            "field"    => null,
                            "uni"      => null,
                            "building" => $buildings[ "statue" ]
                        ] )

                        {{-- TODO --}}
                        {{-- não implementado --}}
                        @include( "users/player/partials.warning", [ "warning_text" => "Recurso não implementado! Status 0%" ] )

                        <div class="row mt-4" >

                            @if ( $village->building_statue > 0 )
                                {{--  --}}
                            @else
                                @include( "users/player/partials.building-require", [ "name" => $buildings[ "statue" ][ "key" ] ] )
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
