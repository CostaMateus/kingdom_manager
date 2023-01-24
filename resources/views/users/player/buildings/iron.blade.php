@extends( "layouts.game" )

@section( "title", $buildings[ "iron" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "iron" ] ] )

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
