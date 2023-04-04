<?php

namespace App\Helpers;

use App\Models\Event;
use App\Models\Village;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Helper
{
    /**
     * Get resource speed multiplier
     *
     * @return string|int|double
     */
    public static function getResourceSpeed()
    {
        return config( "game.speed_resource" );
    }

    /**
     * Get build speed divider
     *
     * @return string|int|double
     */
    public static function getBuildSpeed()
    {
        return config( "game.speed_build" );
    }

    /**
     * Get all villages data
     *
     * @param   Collection $villages
     * @return  array
     */
    public static function getVillagesData( Collection $villages )
    {
        foreach ( $villages as &$village )
        {
            $village->full_research = ( $village->research_spear   && $village->research_sword && $village->research_axe   &&
                                        $village->research_archer  && $village->research_spy   && $village->research_light &&
                                        $village->research_marcher && $village->research_heavy && $village->research_ram   &&
                                        $village->research_catapult ) ? true : false;

            $onOff                  = self::getBuildingsLevel( $village );
            $village->buildings     = json_decode( json_encode( $onOff ), false ); // to object
            $village                = self::calculateBuildingsProps( $village );
        }

        return json_decode( json_encode( $villages ), false );
    }

    /**
     * Process buildings levels
     *
     * @param   Village $village
     * @return  array
     */
    private static function getBuildingsLevel( Village $village )
    {
        $buildings = config( "game_buildings" );

        $on        = [];
        $off       = [];

        foreach ( $buildings as $key1 => $building )
        {
            if ( $village->{ "building_{$key1}" } != 0 || empty( $building[ "required" ] ) )
            {
                $on[ $key1 ]            = $building;
                $on[ $key1 ][ "level" ] = $village->{ "building_{$key1}" };
            }
            else
            {
                $available = [];

                foreach ( $building[ "required" ] as $key2 => $level )
                    $available[] = ( $village->{ "building_{$key2}" } >= $level ) ? true : false;

                if ( in_array( false, $available ) )
                {
                    $off[ $key1 ]            = $building;
                    $off[ $key1 ][ "level" ] = 0;
                }
                else
                {
                    $on[ $key1 ]             = $building;
                    $on[ $key1 ][ "level" ]  = 0;
                }
            }
        }

        return [
            "on"  => $on,
            "off" => $off,
        ];
    }

    /**
     * Process buildings props
     *
     * @param   Village $village
     * @param   string  $building_key
     * @param   integer $start
     * @return  Village
     */
    private static function calculateBuildingsProps( Village $village, string $building_key = "", int $start = 0 )
    {
        foreach ( $village->buildings->on as $key => &$building )
        {
            if ( !empty( $building_key ) )
                if ( $key != $building_key )
                    continue;

            if ( !in_array( $key, [ "main", "wood" ] ) ) continue;

            foreach ( range( $start, $building->level ) as $i )
            {
                $building->build_time       = self::getBuildTIme( $village->buildings->on->main, $building );
                $building->build_time_real *= $building->build_time_factor;

                if ( $i == 0 ) continue;

                $building->wood       = $building->wood * $building->wood_factor;
                $building->clay       = $building->clay * $building->clay_factor;
                $building->iron       = $building->iron * $building->iron_factor;

                $baseBuilding         = config( "game_buildings" )[ $key ];

                $pop                  = $baseBuilding[ "pop"    ];
                $auxPop               = $building->pop_factor * $pop * $i;
                $building->pop        = $auxPop - ( $pop * $i );

                if ( !in_array( $key, [ "farm", "warehouse" ] ) )
                    if ( $building->pop < 1 )
                        $building->pop = 1;

                $points               = $baseBuilding[ "points" ];
                $auxPoints            = $building->points_factor * $points * $i;
                $building->points     = $auxPoints - ( $points * $i );

                if ( property_exists( $building, "time" ) )
                {
                    $cal            = $building->time * $building->time_factor;
                    $base           = $building->time + round( $cal, 0, PHP_ROUND_HALF_DOWN );
                    $base2          = ( $cal - $base ) * -1;

                    $building->time = ( $i == $building->level ) ? $base2 : $base;
                }

                if ( property_exists( $building, "production" ) ) $building->production = $building->production * $building->production_factor;
                if ( property_exists( $building, "max_pop"    ) ) $building->max_pop    = $building->max_pop    * $building->max_pop_factor;
                if ( property_exists( $building, "capacity"   ) ) $building->capacity   = $building->capacity   * $building->capacity_factor;
                if ( property_exists( $building, "influence"  ) ) $building->influence  = $building->influence  * $building->influence_factor;
                if ( property_exists( $building, "merchants"  ) ) $building->merchants  = $building->merchants  * $building->merchants_factor;
                if ( property_exists( $building, "range"      ) ) $building->range      = $building->range      * $building->range_factor;
                if ( property_exists( $building, "defense"    ) ) $building->defense    = $building->defense    * $building->defense_factor;
            }
        }

        $village->prod_wood = ( ( $village->building_wood > 0 ) ? $village->buildings->on->wood->production : 0 ) * self::getResourceSpeed();
        $village->prod_clay = ( ( $village->building_clay > 0 ) ? $village->buildings->on->clay->production : 0 ) * self::getResourceSpeed();
        $village->prod_iron = ( ( $village->building_iron > 0 ) ? $village->buildings->on->iron->production : 0 ) * self::getResourceSpeed();

        return $village;
    }

    /**
     * Get construction time of building
     *
     * @param   object $main
     * @param   object $building
     * @return  float|double|int
     */
    private static function getBuildTIme( object $main, object $building )
    {
        $base  = $building->build_time_real * $building->build_time_factor;

        if ( $building->key == "main" ) return $base;

        $perc  = 100 - ( int ) $main->time;
        $cal   = $base - ( $base * ( $perc / 100 ) );
        $cal   = round( $cal, 0, PHP_ROUND_HALF_DOWN );

        return $cal / self::getBuildSpeed();
    }

    /**
     * Get image of building according to the level
     *
     * @param   string  $building
     * @param   int     $level
     * @return  int
     */
    public static function getLevelImage( $building, $level )
    {
        switch ( $building )
        {
            case "academy":
            case "hide":
            case "place":
            case "statue":
                return 1;
            break;

            case "barracks":
                return ( $level < 6 ) ? 1 : ( ( $level < 21 ) ? 2 : 3 );
            break;

            case "workshop":
                return ( $level < 6 ) ? 1 : ( ( $level < 11 ) ? 2 : 3 );
            break;

            case "church":
                return ( $level == 1 ) ? 1 : ( ( $level == 2 ) ? 2 : 3 );
            break;

            case "main":
            case "wood":
            case "clay":
            case "iron":
            case "farm":
            case "warehouse":
                return ( $level < 10 ) ? 1 : ( ( $level < 20 ) ? 2 : 3 );
            break;

            case "market":
            case "stable":
            case "smithy":
            case "wall":
            case "watchtower":
                return ( $level < 6 ) ? 1 : ( ( $level < 16 ) ? 2 : 3 );
            break;

        }
    }

    /**
     * Processes the gain of resources according to $time
     *
     * @param   Village $village
     * @param   integer $capacity
     * @param   array   $production
     * @param   integer $time
     * @return  array
     */
    public function processResources( Village $village, int $capacity, array $production, int $time )
    {
        $resources = [
            "wood" => 0,
            "clay" => 0,
            "iron" => 0,
        ];

        foreach ( $resources as $key => &$value )
        {
            $value = $village->{"stored_{$key}"};

            if ( $value < $capacity )
            {
                $value += $time * ( $production[ $key ] / 60 / 60 );

                if ( $value > $capacity )
                    $value  = $capacity;
            }
        }

        return $resources;
    }

    /**
     * Undocumented function
     *
     * @param   Village $v_origin
     * @param   Village $v_processed
     * @return  array
     */
    public function processStoredResource( Village $v_origin, Village $v_processed )
    {
        $current_time = Carbon::now();
        $last_update  = new Carbon( $v_origin->updated_stored );
        $time_elapsed = $current_time->diffInSeconds( $last_update );

        $capacity     = $v_processed->buildings->on->warehouse->capacity;

        $production   = [
            "wood" => $v_processed->prod_wood,
            "clay" => $v_processed->prod_clay,
            "iron" => $v_processed->prod_iron,
        ];

        return self::processResources( $v_origin, $capacity, $production, ( int ) $time_elapsed );
    }

}
