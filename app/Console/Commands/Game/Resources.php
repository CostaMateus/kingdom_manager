<?php

namespace App\Console\Commands\Game;

use App\Models\Village;
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
        $villages  = Village::all();
        $buildings = [
            "wood"      => config( "game_buildings.wood"      ),
            "clay"      => config( "game_buildings.clay"      ),
            "iron"      => config( "game_buildings.iron"      ),
            "warehouse" => config( "game_buildings.warehouse" ),
        ];

        foreach ( $villages as $village )
        {
            $this->calc( $village, "warehouse", "capacity", $buildings );

            if ( $village->building_wood > 0 )
            {
                $this->calc( $village, "wood", "production", $buildings );
                $wood = $buildings[ "wood" ][ "production" ]; // / 60;
                $village->stored_wood = round( $village->stored_wood + $wood );

                if ( $village->stored_wood > $buildings[ "warehouse" ][ "capacity" ] )
                    $village->stored_wood = $buildings[ "warehouse" ][ "capacity" ];
            }

            if ( $village->building_clay > 0 )
            {
                $this->calc( $village, "clay", "production", $buildings );
                $clay = $buildings[ "clay" ][ "production" ]; // / 60;
                $village->stored_clay = round( $village->stored_clay + $clay );

                if ( $village->stored_clay > $buildings[ "warehouse" ][ "capacity" ] )
                    $village->stored_clay = $buildings[ "warehouse" ][ "capacity" ];
            }

            if ( $village->building_iron > 0 )
            {
                $this->calc( $village, "iron", "production", $buildings );
                $iron = $buildings[ "iron" ][ "production" ]; // / 60;
                $village->stored_iron = round( $village->stored_iron + $iron );

                if ( $village->stored_iron > $buildings[ "warehouse" ][ "capacity" ] )
                    $village->stored_iron = $buildings[ "warehouse" ][ "capacity" ];
            }

            $village->save();
        }
    }

    private function calc( Village $village, string $building, string $type, array &$buildings )
    {
        $level = $village->{"building_{$building}"};

        if ( $level > 1 )
            foreach ( range( 2, $level ) as $i )
                $buildings[ $building ][ $type ] = $buildings[ $building ][ $type ] * $buildings[ $building ][ "{$type}_factor" ];
    }
}
