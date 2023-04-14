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
        // $villages = $villages->keyBy( "id" );
        $villages = Village::where( "user_id", auth()->user()->id )->get();
        $villages = Helper::getVillagesData( $villages );

        $merge    = [ "villages" => $villages ];

        if ( $request->route( "village" ) )
        {
            $village = $request->route( "village" );

            foreach ( $villages as $v )
            {
                if ( $v->id == $village->id )
                {
                    $resources = Helper::processStoredResource( $village, $v );

                    foreach ( $resources as $key => $value )
                        $v->{"stored_{$key}"} = $value;

                    switch ( $request->route()->getName() )
                    {
                        case "village.overview":
                        case "village.main":
                            $data = Helper::getBuildEvents( $village, $v );
                        break;

                        case "village.barracks":
                            $data = Helper::getTrainEvents( $village, $v, "barracks" );
                        break;

                        case "village.stable":
                            $data = Helper::getTrainEvents( $village, $v, "stable"   );
                        break;

                        case "village.workshop":
                            $data = Helper::getTrainEvents( $village, $v, "workshop" );
                        break;

                        case "village.smithy":
                            $data = Helper::getResearchEvents( $village, $v );
                        break;

                        case "village.place":
                            $data = Helper::getArmyEvents( $village, $v );
                        break;

                        case "village.church":
                        case "village.academy":
                        case "village.statue":
                        case "village.market":
                        case "village.wood":
                        case "village.clay":
                        case "village.iron":
                        case "village.farm":
                        case "village.warehouse":
                        case "village.hide":
                        case "village.wall":
                        case "village.watchtower":
                            $data = [ "village" => $v ];
                        break;
                    }

                    $merge = array_merge( $merge, $data );
                    break;
                }
            }
        }

        $request->merge( $merge );

        return $next( $request );
    }
}
