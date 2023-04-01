<?php

namespace App\Http\Middleware\TW;

use Closure;
use Illuminate\Http\Request;

class CheckVillageUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle( Request $request, Closure $next )
    {
        if ( auth()->user()->id != $request->village->user_id ) return redirect()->route( "home" );

        return $next( $request );
    }
}
