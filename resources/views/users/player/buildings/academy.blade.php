@extends( "layouts.game" )

@section( "title", $buildings->academy->name )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class="col-12 col-md-10 mx-auto" >
                <div class="card border-0" >
                    <div class="card-header" >{{ $village->name }} | {{ $village->points }} pontos</div>

                    <div class="card-body" >
                        {{-- descricao do edificio --}}
                        @include( "users/player/partials.building-description", [
                            "title"    => "Tempo reduzido por nível",
                            "field"    => "time",
                            "uni"      => "%",
                            "building" => $buildings->academy
                        ] )

                        {{-- TODO --}}
                        {{-- não implementado --}}
                        @include( "users/player/partials.warning", [ "warning_text" => "Recurso não implementado! Status 0%" ] )

                        <div class="row mt-4" >

                            @if ( $village->building_academy > 0 )
                                {{--  --}}
                            @else
                                @include( "users/player/partials.building-require", [ "name" => $buildings->academy->key ] )
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include( "users/player/partials.update-village-resources" )
