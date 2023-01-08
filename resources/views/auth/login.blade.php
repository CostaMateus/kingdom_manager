@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row justify-content-center" >
        <dviv class="col-12 col-sm-6 col-md-4" >
            <div class="card" >
                <div class="card-header" >{{ __( 'Login' ) }}</div>

                <div class="card-body" >
                    <form method="POST" action="{{ route( 'login' ) }}" >
                        @csrf

                        <div class="row mb-3" >
                            <label for="nickname" class="col-12 col-form-label" >Nick / E-mail</label>

                            <div class="col-12" >
                                <input id="nickname" type="nickname" class="form-control @error( 'email' ) is-invalid @enderror" name="nickname" value="{{ old( 'nickname' ) }}" required autocomplete="nickname" autofocus >

                                @error( 'email' )
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <label for="password" class="col-12 col-form-label" >{{ __( 'Password' ) }}</label>

                            <div class="col-12" >
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" >
                            </div>
                        </div>

                        <div class="row mb-3" >
                            <div class="col-12" >
                                <div class="form-check" >
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember' ) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember" >{{ __( 'Remember Me' ) }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0" >
                            <div class="col-12" >
                                @if ( Route::has( 'password.request' ) )
                                    <a class="btn btn-link px-0" href="{{ route( 'password.request' ) }}" >
                                        {{ __( 'Forgot Your Password?' ) }}
                                    </a>
                                @endif

                                <button type="submit" class="btn btn-primary float-end" >{{ __( 'Login' ) }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </dviv>
    </div>
</div>
@endsection
