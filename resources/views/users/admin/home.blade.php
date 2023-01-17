@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="row mt-3">
                        <div class="col-12">
                            <a class="btn btn-light" href="{{ route( "admin.users.index"       ) }}">Lista de novos usuários</a>
                            <a class="btn btn-light" href="{{ route( "admin.generate.villages" ) }}">Gerar aldeias</a>
                        </div>
                        <div class="col-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
