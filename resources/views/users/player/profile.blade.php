@extends( "layouts.game" )

@section( "title", "Perfil" )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            <div class="col-12 col-md-10 mx-auto"  >
                <div class="card border-0" >

                    <div class="card-body px-3" >
                        <p class="fw-bold h3 mb-0" >Perfil</p>

                        {{-- não implementado --}}
                        @include( "users/player/partials.warning", [ "warning_text" => "Perfil não implementado!" ] )
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
