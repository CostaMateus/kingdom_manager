@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de usuária para aprovar</div>

                    <div class="card-body">

                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Nick</th>
                                    <th>E-mail</th>
                                    <th>Registrado em</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="align-middle" >
                                        <td>{{ $user->nickname   }}</td>
                                        <td>{{ $user->email      }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td><a href="{{ route( "admin.users.approve", $user ) }}" class="btn btn-primary btn-sm" >Aprovar</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Sem usuários para aprovar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
