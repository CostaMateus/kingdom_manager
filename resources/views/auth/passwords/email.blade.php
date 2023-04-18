@extends( "layouts.app" )

@section( "content" )
    <div class="container d-flex flex-column justify-content-center h-100 w-100" >
        <div class="row align-content-center" >

            <div id="km-main" class="col-12 mx-auto text-center px-0 pt-0 pb-4" >
                [{{ config( "app.name", "Laravel" ) }}]
            </div>

            <div class="card col-12 col-sm-10 col-md-5 col-lg-4 mx-auto p-0" >
                <div class="card-header text-center" >{{ __( "Reset Password" ) }}</div>

                <div class="card-body p-3" >
                    @if (session( "status" ))
                        <div class="alert alert-success" role="alert" >
                            {{ session( "status" ) }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route( "password.email" ) }}" >
                        @csrf

                        <div class="row mb-3" >
                            <label for="email" class="col-12 col-form-label" >{{ __( "Email Address" ) }}</label>

                            <div class="col-12" >
                                <input id="email" type="email" class="form-control @error( "email" ) is-invalid @enderror" name="email" value="{{ old( "email" ) }}" required autocomplete="email" autofocus>

                                @error( "email" )
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0" >
                            <div class="col-12 text-center d-grid" >
                                <button type="submit" class="btn btn-primary border-secondary text-dark" >{{ __( "Send Password Reset Link" ) }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @include( "layouts.footer" )

        </div>
    </div>
</div>
@endsection
