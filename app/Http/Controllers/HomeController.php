<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view( "home" );
    }

    /**
     * Show the pending approval page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function approval()
    {
        return view( "users.player.approval" );
    }
}
