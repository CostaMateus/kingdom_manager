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
        // // checks if the user's village collection has the Village->ID passed in the request
        // if ( !auth()->user()->villages->contains( "id", $request->village ) )

        if ( auth()->user()->id != $request->village->user_id ) return redirect()->route( "home" );

        return $next( $request );
    }
}
