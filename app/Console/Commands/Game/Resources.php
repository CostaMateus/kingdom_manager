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
        $speed        = config( "game.speed" );

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
            $changed = false;

            $this->calc( $village, "warehouse", "capacity", $buildings );

            if ( $village->building_wood > 0 && $village->stored_wood < $buildings[ "warehouse" ][ "capacity" ] )
            {
                $this->calc( $village, "wood", "production", $buildings );

                /**
                 * TODO dividir por 60 no futuro
                 */
                $wood = $buildings[ "wood" ][ "production" ] * $speed;
                $village->stored_wood = ( int ) $village->stored_wood + $wood;

                if ( $village->stored_wood > $buildings[ "warehouse" ][ "capacity" ] )
                    $village->stored_wood = $buildings[ "warehouse" ][ "capacity" ];

                $changed = true;
            }

            if ( $village->building_clay > 0 && $village->stored_clay < $buildings[ "warehouse" ][ "capacity" ] )
            {
                $this->calc( $village, "clay", "production", $buildings );

                /**
                 * TODO dividir por 60 no futuro
                 */
                $clay = $buildings[ "clay" ][ "production" ] * $speed;
                $village->stored_clay = ( int ) $village->stored_clay + $clay;

                if ( $village->stored_clay > $buildings[ "warehouse" ][ "capacity" ] )
                    $village->stored_clay = $buildings[ "warehouse" ][ "capacity" ];

                $changed = true;
            }

            if ( $village->building_iron > 0 && $village->stored_iron < $buildings[ "warehouse" ][ "capacity" ] )
            {
                $this->calc( $village, "iron", "production", $buildings );

                /**
                 * TODO dividir por 60 no futuro
                 */
                $iron = $buildings[ "iron" ][ "production" ] * $speed;
                $village->stored_iron = ( int ) $village->stored_iron + $iron;

                if ( $village->stored_iron > $buildings[ "warehouse" ][ "capacity" ] )
                    $village->stored_iron = $buildings[ "warehouse" ][ "capacity" ];

                $changed = true;
            }

            if ( $changed ) $village->save();

            $buildings = $auxBuildings;
        }
    }

    private function calc( Village $village, string $building, string $type, array &$buildings )
    {
        $level = $village->{"building_{$building}"};

        if ( $level > 1 )
            foreach ( range( 2, $level ) as $i )
                $buildings[ $building ][ $type ] = ( int ) $buildings[ $building ][ $type ] * $buildings[ $building ][ "{$type}_factor" ];
    }
}
