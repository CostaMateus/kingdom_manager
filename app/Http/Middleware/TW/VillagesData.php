<?php

namespace App\Http\Middleware\TW;

use Closure;
use App\Helpers\Helper;
use App\Models\Village;
use Illuminate\Http\Request;

class VillagesData
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
        $villages = Village::where( "user_id", auth()->user()->id )->get();
        $villages = Helper::getVillagesData( $villages );

        $village  = $request->route( "village" );

        foreach ( $villages as $v )
        {
            if ( $v->id == $village->id )
            {
                $village = $v;
                break;
            }
        }

        $village = json_decode( json_encode( $village ), true );

        $request->merge( [
            "villages" => $villages,
            "village"  => $village
        ] );

        return $next( $request );
    }
}
