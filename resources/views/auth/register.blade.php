@extends( "layouts.app" )

@section( "content" )
    <div class="container d-flex flex-column justify-content-center h-100 w-100" >
        <div class="row align-content-center" >

            <div id="km-main" class="col-12 mx-auto text-center px-0 pt-0 pb-4" >
                [{{ config( "app.name", "Laravel" ) }}]
            </div>

            <div class="card col-12 col-sm-10 col-md-5 col-lg-4 mx-auto p-0" >
                <div class="card-header text-center" >{{ __( "Register" ) }}</div>

                <div class="card-body p-3" >
                    <form method="POST" action="{{ route("register") }}" >
                        @csrf

                        <div class="row mb-3" >
                            <label for="nickname" class="col-12 col-form-label" >{{ __( "Nickname" ) }}</label>

                            <div class="col-12" >
                                <input id="nickname" type="text" class="form-control @error( "nickname" ) is-invalid @enderror" name="nickname" value="{{ old( "nickname" ) }}" required autocomplete="nickname" autofocus >

                                @error( "nickname" )
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="email" class="col-12 col-form-label" >{{ __( "Email Address" ) }}</label>

                            <div class="col-12" >
                                <input id="email" type="email" class="form-control @error( "email" ) is-invalid @enderror" name="email" value="{{ old( "email" ) }}" required autocomplete="email" >

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
                                <input id="password" type="password" class="form-control @error( "password" ) is-invalid @enderror" name="password" required autocomplete="new-password" >

                                @error( "password" )
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="password-confirm" class="col-12 col-form-label" >{{ __( "Confirm Password" ) }}</label>

                            <div class="col-12" >
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" >
                            </div>
                        </div>

                        <div class="row mb-0" >
                            <div class="col-12" >
                                <button type="submit" class="btn btn-primary border-secondary text-dark float-end" >{{ __( "Register" ) }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @include( "layouts.footer" )

        </div>
    </div>
@endsection
