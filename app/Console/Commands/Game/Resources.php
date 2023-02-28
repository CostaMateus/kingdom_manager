<?php

namespace App\Console\Commands\Game;

use Carbon\Carbon;
use App\Models\Village;
use App\Events\RealTimeMessage;
use Illuminate\Console\Command;

class Resources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "game:resources";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Command description";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current_time = Carbon::now();

        $villages     = Village::all();
        $auxBuildings = [
            "wood"      => config( "game_buildings.wood"      ),
            "clay"      => config( "game_buildings.clay"      ),
            "iron"      => config( "game_buildings.iron"      ),
            "warehouse" => config( "game_buildings.warehouse" ),
        ];
        $buildings    = $auxBuildings;

        foreach ( $villages as $village )
        {
            $changed      = false;
            $last_update  = new Carbon( $village->updated_stored );
            $time_elapsed = $current_time->diffInSeconds( $last_update );

            $this->calc( $village, "warehouse", "capacity", $buildings );

            if ( $village->building_wood > 0 && $village->stored_wood < $buildings[ "warehouse" ][ "capacity" ] )
            {
                $this->calc( $village, "wood", "production", $buildings );

                $wood_produced        = $time_elapsed * ( $buildings[ "wood" ][ "production" ] / 60 / 60 );
                $new_wood             = $village->stored_wood + $wood_produced;
                $village->stored_wood = $new_wood;

                if ( $village->stored_wood > $buildings[ "warehouse" ][ "capacity" ] )
                    $village->stored_wood = $buildings[ "warehouse" ][ "capacity" ];

                $changed = true;
            }

            if ( $village->building_clay > 0 && $village->stored_clay < $buildings[ "warehouse" ][ "capacity" ] )
            {
                $this->calc( $village, "clay", "production", $buildings );

                $clay_produced        = $time_elapsed * ( $buildings[ "clay" ][ "production" ] / 60 / 60 );
                $new_clay             = $village->stored_clay + $clay_produced;
                $village->stored_clay = $new_clay;

                if ( $village->stored_clay > $buildings[ "warehouse" ][ "capacity" ] )
                    $village->stored_clay = $buildings[ "warehouse" ][ "capacity" ];

                $changed = true;
            }

            if ( $village->building_iron > 0 && $village->stored_iron < $buildings[ "warehouse" ][ "capacity" ] )
            {
                $this->calc( $village, "iron", "production", $buildings );

                $iron_produced        = $time_elapsed * ( $buildings[ "iron" ][ "production" ] / 60 / 60 );
                $new_iron             = $village->stored_iron + $iron_produced;
                $village->stored_iron = $new_iron;

                if ( $village->stored_iron > $buildings[ "warehouse" ][ "capacity" ] )
                    $village->stored_iron = $buildings[ "warehouse" ][ "capacity" ];

                $changed = true;
            }

            if ( $changed )
            {
                $village->updated_stored = now();
                $village->save();
            }

            $buildings = $auxBuildings;
        }
    }

    private function calc( Village $village, string $building, string $type, array &$buildings )
    {
        $speed = config( "game.speed" );
        $level = $village->{"building_{$building}"};

        if ( $level > 0 )
        {
            foreach ( range( 1, $level ) as $i )
            {
                $t   = $buildings[ $building ][ $type ];
                $tf  = $buildings[ $building ][ "{$type}_factor" ];
                $aux = ( $type == "production" ) ? $t * $tf * $speed : $t * $tf;

                $buildings[ $building ][ $type ] = $aux;
            }
        }
    }
}
