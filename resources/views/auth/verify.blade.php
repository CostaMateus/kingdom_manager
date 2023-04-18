@extends( "layouts.app" )

@section( "content" )
    <div class="container d-flex flex-column justify-content-center h-100 w-100" >
        <div class="row align-content-center" >

            <div id="km-main" class="col-12 mx-auto text-center px-0 pt-0 pb-4" >
                [{{ config( "app.name", "Laravel" ) }}]
            </div>

            <div class="card col-12 col-sm-10 col-md-5 col-lg-4 mx-auto p-0" >
                <div class="card-header text-center" >{{ __( "Verify Your Email Address" ) }}</div>

                <div class="card-body p-3" >
                    @if ( session( "resent" ) )
                        <div class="alert alert-success" role="alert" >
                            {{ __( "A fresh verification link has been sent to your email address." ) }}
                        </div>
                    @endif

                    {{ __( "Before proceeding, please check your email for a verification link." ) }}
                    {{ __( "If you did not receive the email" ) }},
                    <form class="d-inline" method="POST" action="{{ route( "verification.resend" ) }}" >
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-dark" >{{ __( "click here to request another" ) }}</button>.
                    </form>
                </div>
            </div>

            @include( "layouts.footer" )

        </div>
    </div>
@endsection
