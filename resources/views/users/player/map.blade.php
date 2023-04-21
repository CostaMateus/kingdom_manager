@extends( "layouts.game" )

@section( "title", "Mapa" )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            <div class="col-12 col-md-10 mx-auto"  >
                <div class="card border-0" >

                    <div class="card-body px-3" >
                        <p class="fw-bold h3 mb-0" >Mapa</p>

                        {{-- não implementado --}}
                        @include( "users/player/partials.warning", [ "warning_text" => "Mapa não implementado!" ] )
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
