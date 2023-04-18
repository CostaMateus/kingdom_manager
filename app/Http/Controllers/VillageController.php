<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Helpers\Helper;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BuildingRequest;
use Illuminate\Support\Facades\Storage;

class VillageController extends Controller
{
    private $compact;
    private $helper;

    /**
     * Construct
     *
     * @return  void
     */
    public function __construct()
    {
        $this->helper  = new Helper();

        $buildings     = config( "game_buildings" );
        $units         = config( "game_units"     );

        $this->compact = [
            "buildings" => $buildings,
            "units"     => $units,
        ];
    }

    /**
     * Insert data in compact
     *
     * @param   Request $request
     * @return  void
     */
    private function insertDataCompact( Request $request )
    {
        if ( isset( $request->villages ) )
            $this->compact[ "villages" ] = $request->villages;

        if ( isset( $request->village ) )
            $this->compact[ "village"  ] = $request->village;

        if ( isset( $request->events ) )
            $this->compact[ "events"   ] = $request->events;
    }

    /**
     * Main screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function overview( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.overview", $this->compact );
    }

    /**
     * Main building screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function main( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.main", $this->compact );
    }

    /**
     * Barracks screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function barracks( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.barracks", $this->compact );
    }

    /**
     * Stable screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function stable( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.stable", $this->compact );
    }

    /**
     * Workshop screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function workshop( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.workshop", $this->compact );
    }

    /**
     * Smithy screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function smithy( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.smithy", $this->compact );
    }

    /**
     * Church screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function church( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.church", $this->compact );
    }

    /**
     * Academy screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function academy( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.academy", $this->compact );
    }

    /**
     * Place screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function place( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.place", $this->compact );
    }

    /**
     * Statue screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function statue( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.statue", $this->compact );
    }

    /**
     * Market screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function market( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.market", $this->compact );
    }

    /**
     * Wood screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function wood( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.wood", $this->compact );
    }

    /**
     * Clay screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function clay( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.clay", $this->compact );
    }

    /**
     * Iron screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function iron( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.iron", $this->compact );
    }

    /**
     * Farm screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function farm( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.farm", $this->compact );
    }

    /**
     * Warehouse screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function warehouse( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.warehouse", $this->compact );
    }

    /**
     * Hide screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function hide( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.hide", $this->compact );
    }

    /**
     * Wall screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function wall( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.wall", $this->compact );
    }

    /**
     * Watchtower screen
     *
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function watchtower( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.watchtower", $this->compact );
    }

    /**
     * Change the name of the village
     *
     * @param   Request $request
     * @param   Village $village
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function changeVillageName( Request $request, Village $village )
    {
        if ( $village->name != $name = $request->name )
        {
            $village->name = $name;
            $village->save();
        }

        return redirect()->back();
    }

    /**
     * Add building in queue to construct
     *
     * @param   Village $village
     * @param   string $building
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function upgradeBuilding( BuildingRequest $request, Village $village, string $building )
    {
        $this->insertDataCompact( $request );

        $events   = $this->compact[ "events" ];

        // // msg de erro - fila cheia
        // if ( $events->count() >= 5 )
        //     return redirect()->route( "village.main", [ "village" => $village ] );

        $auxVlg   = $this->compact[ "village" ];

        $building = ( property_exists( $auxVlg->buildings->on, $building ) )
                    ? $auxVlg->buildings->on->$building
                    : $auxVlg->buildings->off->$building;

        if ( $building->level < $building->max_level )
        {
            // free pop
            $fp = $auxVlg->buildings->on->farm->max_pop - $auxVlg->pop;

            $w  = ( int ) $building->wood == ( int ) $request->wood;
            $c  = ( int ) $building->clay == ( int ) $request->clay;
            $i  = ( int ) $building->iron == ( int ) $request->iron;
            $p  = $building->pop <= $fp || $building->pop == 0;

            if ( $w && $c && $i && $p )
            {
                $new_wood  = 0;
                $new_clay  = 0;
                $new_iron  = 0;

                $resources = Helper::processStoredResource( $village, $auxVlg );

                foreach ( $resources as $key => $value ) ${"new_{$key}"} = $value;

                if ( $new_wood >= $building->wood &&
                     $new_clay >= $building->clay &&
                     $new_iron >= $building->iron )
                {
                    $village->updated_stored  = now();
                    $village->stored_wood     = $new_wood - $building->wood;
                    $village->stored_clay     = $new_clay - $building->clay;
                    $village->stored_iron     = $new_iron - $building->iron;
                    $village->pop            += ( int ) $building->pop;
                    $village->save();

                    // add event
                    $duration = ( int ) $building->build_time;
                    $start    = ( $events->count() > 0 ) ? Carbon::parse( $events->last()->finish )->toImmutable() : Carbon::now()->toImmutable();
                    $finish   = $start->addSeconds( $duration );

                    $event    = Event::create( [
                        "village_id" => $village->id,
                        "type"       => Event::BUILDING,
                        "start"      => $start,
                        "finish"     => $finish,
                        "duration"   => $duration
                    ] );

                    DB::table( "events_buildings" )->insert( [
                        "event_id"   => $event->id,
                        "technology" => $building->key,
                        "wood"       => $building->wood,
                        "clay"       => $building->clay,
                        "iron"       => $building->iron,
                        "pop"        => $building->pop,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ] );

                    // success
                    $result = redirect()->route( "village.main", [ "village" => $village ] );
                }
                else
                {
                    // msg de erro
                    // recursos indisponiveis
                    $result = redirect()->route( "village.main", [ "village" => $village ] );
                }
            }
            else
            {
                // msg de erro
                // recursos indisponiveis | diferenca entre requisito e informado
                $result = redirect()->route( "village.main", [ "village" => $village ] );
            }
        }
        else
        {
            // msg de erro
            // edificio no nivel maximo
            $result = redirect()->route( "village.main", [ "village" => $village ] );
        }

        return $result;
    }

    public function cancelUpgradeBuilding( Request $request, Village $village, Event $event )
    {
        $this->insertDataCompact( $request );

        $auxVillage = $this->compact[ "village" ];
        $events     = $this->compact[ "events"  ];
        $index      = array_search( $event->id, array_column( $events->toArray(), "id" ) );
        $event      = $events[ $index ];


        if ( $events->count() == 1 )
        {
            Helper::cancelBuildingEvent( $village, $auxVillage, $event );
        }
        elseif ( $event->id == $events->last()->id )
        {
            $event = $events->last();
            Helper::cancelBuildingEvent( $village, $auxVillage, $event );
        }
        else
        {
            foreach ( $events as $i => $e )
            {
                if ( $i <= $index ) continue;

                if ( $event->key == $e->key )
                {
                    if ( $events->last()->id != $e->id ) continue;

                    $event = $events[ $i ];
                    break;
                }

                $event = $events[ $i - 1 ];
                break;
            }

            Helper::cancelBuildingEvent( $village, $auxVillage, $event );

            if ( $events->last()->id != $event->id )
                Helper::updateBuildingQueue( $village, $index );
        }

        return redirect()->route( "village.main", [ "village" => $village ] );
    }
}
