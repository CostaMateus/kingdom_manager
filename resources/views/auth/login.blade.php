@extends( "layouts.app" )

@section( "content" )
    <div class="container d-flex flex-column justify-content-center h-100 w-100" >
        <div class="row align-content-center" >

            <div id="km-main" class="col-12 mx-auto text-center px-0 pt-0 pb-4" >
                [{{ config( "app.name", "Laravel" ) }}]
            </div>

            <div class="card col-11 col-sm-10 col-md-5 col-lg-3 mx-auto p-0" >
                <div class="card-body p-3" >

                    <form method="POST" action="{{ route( "login" ) }}" >
                        @csrf

                        <div class="row mb-3" >
                            <label for="nickname" class="col-12 col-form-label" >E-mail / Nick</label>

                            <div class="col-12" >
                                <input id="nickname" type="nickname" class="form-control @error( "email" ) is-invalid @enderror" name="nickname" value="{{ old( "nickname" ) }}" required autocomplete="nickname" autofocus >

                                @error( "email" )
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="password" class="col-12 col-form-label" >{{ __( "Password" ) }}</label>

                            <div class="col-12" >
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" >
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <div class="col-12" >
                                <div class="form-check" >
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( "remember" ) ? "checked" : "" }}>
                                    <label class="form-check-label" for="remember" >{{ __( "Remember Me" ) }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0" >
                            <div class="col-8 my-auto" >
                                @if ( Route::has( "password.request" ) )
                                    <div class="float-start" >
                                        <a class="btn btn-link text-dark p-0" href="{{ route( "password.request" ) }}" >
                                            {{ __( "Forgot Your Password?" ) }}
                                        </a>
                                        <a class="btn btn-link text-dark p-0" href="{{ route( "register" ) }}" >
                                            Crie sua conta!
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-4 my-auto" >
                                <button type="submit" class="btn btn-primary border-secondary text-dark float-end" >{{ __( "Login" ) }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            @include( "layouts.footer" )

        </div>
    </div>
@endsection
