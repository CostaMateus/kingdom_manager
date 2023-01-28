@extends( "layouts.game" )

@section( "title", $buildings[ "warehouse" ][ "name" ] )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [ "building" => $buildings[ "warehouse" ] ] )

                        @if ( $village->building_warehouse > 0 )
                            <p>ok</p>
                        @else
                            @include( "users/player/partials.building-require", [ "name" => $buildings[ "warehouse" ][ "key" ] ] )
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
