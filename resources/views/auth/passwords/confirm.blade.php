@extends( "layouts.app" )

@section( "content" )
    <div class="container d-flex flex-column justify-content-center h-100 w-100" >
        <div class="row align-content-center" >

            <div id="km-main" class="col-12 mx-auto text-center px-0 pt-0 pb-4" >
                [{{ config( "app.name", "Laravel" ) }}]
            </div>

            <div class="card col-12 col-sm-10 col-md-5 col-lg-4 mx-auto p-0" >
                <div class="card-header text-center" >{{ __( "Confirm Password" ) }}</div>

                <div class="card-body" >
                    {{ __( "Please confirm your password before continuing." ) }}

                    <form method="POST" action="{{ route( "password.confirm" ) }}" >
                        @csrf

                        <div class="row mb-3" >
                            <label for="password" class="col-12 col-form-label" >{{ __( "Password" ) }}</label>

                            <div class="col-12" >
                                <input id="password" type="password" class="form-control @error( "password" ) is-invalid @enderror" name="password" required autocomplete="current-password" >

                                @error( "password" )
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0" >
                            <div class="col-12" >
                                @if (Route::has( "password.request" ))
                                    <a class="btn btn-link px-0" href="{{ route( "password.request" ) }}" >
                                        {{ __( "Forgot Your Password?" ) }}
                                    </a>
                                @endif

                                <button type="submit" class="btn btn-primary float-end" >
                                    {{ __( "Confirm Password" ) }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @include( "layouts.footer" )

        </div>
    </div>
@endsection
