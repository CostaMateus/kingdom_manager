<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNull( "approved_at" )->get();

        return view( "users.admin.approval-users", compact( "users" ) );
    }

    public function approve( Request $request, User $user )
    {
        $user->update( [ "approved_at" => now() ] );

        Village::create( [
            "user_id" => $user->id,
            "name"    => "Aldeia de {$user->nickname}"
        ] );

        return redirect()->route( "admin.users.index" )->withMessage( "Usuário aprovado com sucesso" );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( UserRequest $request )
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show( User $user )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update( UserRequest $request, User $user )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( User $user )
    {
        //
    }
}
