@extends( "layouts.game" )

@section( "title", $buildings[ "watchtower" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "watchtower" ] ] )

                        @if ( $village->building_watchtower > 0 )
                            {{-- TODO --}}
                            <p class="mt-3 mb-0 text-center fw-bold fs-3" >POR FAZER</p>
                        @else
                            @if ( !empty( $buildings[ "watchtower" ][ "required" ] ) )
                                @include( "users/player/partials.building-require", [ "name" => $buildings[ "watchtower" ][ "key" ] ] )
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
