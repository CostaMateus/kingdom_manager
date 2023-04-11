<?php

namespace App\Helpers;

use App\Models\Event;
use App\Models\Village;
use Illuminate\Support\Carbon;

class HelperBKP
{
    public function getResourceSpeed()
    {
        return config( "game.speed_resource" );
    }

    public function getBuildSpeed()
    {
        return config( "game.speed_build" );
    }

    public function getVillages( array $data )
    {
        $villages = null;

        if ( !isset( $data[ "villages" ] ) )
        {
            $villages = Village::where( "user_id", auth()->user()->id )->get();

            foreach ( $villages as &$village )
            {
                $researched[] = $village->research_spear;
                $researched[] = $village->research_sword;
                $researched[] = $village->research_axe;
                $researched[] = $village->research_archer;
                $researched[] = $village->research_spy;
                $researched[] = $village->research_light;
                $researched[] = $village->research_marcher;
                $researched[] = $village->research_heavy;
                $researched[] = $village->research_ram;
                $researched[] = $village->research_catapult;

                $village->full_research = in_array( false, $researched ) ? false : true;

                $auxOnOff               = $this->getBuildingsLevel( $data[ "buildings" ], $village );
                $village->buildings     = json_decode( json_encode( $auxOnOff ), false );
                $village                = $this->calcBuildingsProps( $village );
            }
        }

        return $villages;
    }

    private function getBuildingsLevel( array $buildings, Village $village )
    {
        $buildingsOn  = [];
        $buildingsOff = [];

        foreach ( $buildings as $key1 => $building )
        {
            if ( $village->{ "building_{$key1}" } != 0 || empty( $building[ "required" ] ) )
            {
                $buildingsOn[ $key1 ] = $building;
            }
            else
            {
                $toBuild = [];

                foreach ( $building[ "required" ] as $key2 => $level )
                    $toBuild[] = ( $village->{ "building_{$key2}" } >= $level ) ? true : false;

                if ( in_array( false, $toBuild ) )
                    $buildingsOff[ $key1 ] = $building;
                else
                    $buildingsOn[ $key1 ]  = $building;
            }
        }

        return [
            "on"  => json_decode( json_encode( $buildingsOn  ), false ),
            "off" => json_decode( json_encode( $buildingsOff ), false ),
        ];
    }

    public function calcBuildingsProps( Village $village, string $b_key = "", int $start = 1 )
    {
        foreach ( $village->buildings->on as $key => &$building )
        {
            if ( !empty( $b_key ) )
                if ( $key != $b_key )
                    continue;

            $building->level = $village->{"building_{$key}"};

            foreach ( range( $start, $building->level ) as $i )
            {
                $building->build_time = $this->getBuildTIme( $village->buildings->on->main, $building );

                if ( $building->level == 1 ) continue;

                $building->wood       = $building->wood   * $building->wood_factor;
                $building->clay       = $building->clay   * $building->clay_factor;
                $building->iron       = $building->iron   * $building->iron_factor;

                $building->pop        = $building->pop    * $building->pop_factor;

                $auxPoints1           = $building->points * $building->points_factor;
                $auxPoints2           = $auxPoints1 - $building->points;
                $building->points     = ( $i == $building->level ) ? $auxPoints2 : $auxPoints1;

                if ( property_exists( $building, "time" ) )
                {
                    $cal   = $building->time * $building->time_factor;
                    $base  = $building->time + round( $cal, 0, PHP_ROUND_HALF_DOWN );
                    $base2 = ( $cal - $base ) * -1;

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

            $building->build_time_final = $building->build_time / $this->getBuildSpeed();
        }

        if ( $village->buildings->off )
            foreach ( $village->buildings->off as &$building )
                $building->level = 0;

        $village->prod_wood = ( ( $village->building_wood > 0 ) ? $village->buildings->on->wood->production : 0 ) * $this->getResourceSpeed();
        $village->prod_clay = ( ( $village->building_clay > 0 ) ? $village->buildings->on->clay->production : 0 ) * $this->getResourceSpeed();
        $village->prod_iron = ( ( $village->building_iron > 0 ) ? $village->buildings->on->iron->production : 0 ) * $this->getResourceSpeed();

        return $village;
    }

    private function getBuildTIme( $main, $building )
    {
        if ( $building->key == "main" ) return $building->build_time * $building->build_time_factor;

        $base = $building->build_time * $building->build_time_factor;

        $perc = 100 - $main->time;
        $cal  = $base - ( ( $base * $perc ) / 100 );
        $cal  = round( $cal, 0, PHP_ROUND_HALF_DOWN );

        return $cal;
    }

    public static function formatBuildTime( int $seconds )
    {
        $h = $seconds / 3600;
        $m = $seconds / 60 % 60;
        $s = $seconds % 60;

        return sprintf( "%02d:%02d:%02d", $h, $m, $s );
    }

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

    public function getUnits( &$compact, $building )
    {
        // unidades por aldeia
        // tratar como objeto/json

        $buildings = [
            "barracks" => [ "spear", "sword", "axe", "archer"  ],
            "stable"   => [ "spy", "light", "marcher", "heavy" ],
            "workshop" => [ "ram", "catapult"                  ],
            "smithy"   => [ "spear", "sword", "axe", "archer", "spy", "light", "marcher", "heavy", "ram", "catapult" ],
        ];

        $units     = $buildings[ $building ];
        $unitsOn   = [];
        $unitsOff  = [];

        foreach ( $compact[ "units" ] as $key => $unit )
        {
            if ( in_array( $key, $units ) )
            {
                if ( $compact[ "village" ]->{ "research_{$key}"} != 0 )
                {
                    $unitsOn[ $key ] = $unit;
                }
                else
                {
                    $unitsOff[ $key ] = $unit;
                }
            }
        }

        $compact[ "unitsOn"  ] = $unitsOn;
        $compact[ "unitsOff" ] = $unitsOff;

        $this->calcUnitsProps( $compact );
    }

    private function calcUnitsProps( &$compact )
    {
        $units   = &$compact[ "unitsOn" ];
        $village = &$compact[ "village" ];

        foreach ( $units as $key => &$unit )
        {
            $level = $village->{"research_{$key}"};

            if ( $level > 1 )
            {
                foreach ( range( 2, $level ) as $i )
                {
                    $unit[ "research_wood"   ] = $unit[ "research_wood"   ] * $unit[ "research_factor" ];
                    $unit[ "research_clay"   ] = $unit[ "research_clay"   ] * $unit[ "research_factor" ];
                    $unit[ "research_iron"   ] = $unit[ "research_iron"   ] * $unit[ "research_factor" ];

                    $unit[ "attack"          ] = $unit[ "attack"          ] * $unit[ "attack_factor"   ];
                    $unit[ "defense"         ] = $unit[ "defense"         ] * $unit[ "defense_factor"  ];
                    $unit[ "defense_cavalry" ] = $unit[ "defense_cavalry" ] * $unit[ "defense_factor"  ];
                    $unit[ "defense_archer"  ] = $unit[ "defense_archer"  ] * $unit[ "defense_factor"  ];
                }
            }
        }
    }

    public function processStoredResource( Village $village, int $capacity, array $prods, int $time )
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
                $value += $time * ( $prods[ $key ] / 60 / 60 );

                if ( $value > $capacity )
                    $value  = $capacity;
            }
        }

        return $resources;
    }

    public function processStoredResourceTwoVillages( Village $v_origin, Village $v_processed )
    {
        $current_time = Carbon::now();
        $last_update  = new Carbon( $v_origin->updated_stored );
        $time_elapsed = $current_time->diffInSeconds( $last_update );

        $capacity     = $v_processed->buildings->on->warehouse->capacity;

        $prods        = [
            "wood" => $v_processed->prod_wood,
            "clay" => $v_processed->prod_clay,
            "iron" => $v_processed->prod_iron,
        ];

        $resources    = $this->processStoredResource( $v_origin, $capacity, $prods, ( int ) $time_elapsed );

        foreach ( $resources as $key => $value ) ${$key} = $value;

        return [
            "wood" => $wood,
            "clay" => $clay,
            "iron" => $iron,
        ];
    }

    public static function searchBuildingInEvents( string $key, array $events )
    {
        $count = 0;

        foreach ( $events as $event )
            if ( $event[ "key" ] == $key )
                $count++;

        return $count;
    }

    public function restoreResources( Village $v_origin, Village $v_processed, Event $event )
    {
        $capacity    = $v_processed->buildings->on->warehouse->capacity;
        $resources   = $this->processStoredResourceTwoVillages( $v_origin, $v_processed );

        $stored_wood = $resources[ "wood" ] + $event->wood;
        $stored_clay = $resources[ "clay" ] + $event->clay;
        $stored_iron = $resources[ "iron" ] + $event->iron;

        return [
            "wood" => ( $stored_wood <= $capacity ) ?? $capacity,
            "clay" => ( $stored_clay <= $capacity ) ?? $capacity,
            "iron" => ( $stored_iron <= $capacity ) ?? $capacity,
        ];
    }
}
