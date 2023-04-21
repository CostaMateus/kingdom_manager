<?php

namespace App\Helpers;

use App\Models\Event;
use App\Models\Village;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Helper
{
    /**
     * Get resource speed multiplier
     *
     * @return  string|int|double
     */
    public static function getResourceSpeed()
    {
        return config( "game.speed_resource" );
    }

    /**
     * Get build speed divider
     *
     * @return  string|int|double
     */
    public static function getBuildSpeed()
    {
        return config( "game.speed_build" );
    }

    /**
     * Format seconds to H:i:s
     *
     * @param   integer $seconds
     * @return  string
     */
    public static function formatBuildTime( int $seconds )
    {
        $h = $seconds / 3600;
        $m = $seconds / 60 % 60;
        $s = $seconds % 60;

        return sprintf( "%02d:%02d:%02d", $h, $m, $s );
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

        return $villages;
    }

    /**
     * Get buildings levels
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
     * @param   integer $end
     * @return  Village
     */
    public static function calculateBuildingsProps( Village $village, string $building_key = "", int $start = 0, int $end = 0 )
    {
        foreach ( $village->buildings->on as $key => &$building )
        {
            if ( !empty( $building_key ) )
                if ( $key != $building_key )
                    continue;

            $limit = ( $end != 0 ) ? $end : $building->level;

            foreach ( range( $start, $limit ) as $i )
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

                if ( empty( $building_key ) && property_exists( $building, "production" ) )
                    $building->production = $building->production * $building->production_factor;

                if ( empty( $building_key ) && property_exists( $building, "max_pop"    ) )
                    $building->max_pop    = $building->max_pop    * $building->max_pop_factor;

                if ( empty( $building_key ) && property_exists( $building, "capacity"   ) )
                    $building->capacity   = $building->capacity   * $building->capacity_factor;

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

        if ( $building->key == "main" ) return $base / self::getBuildSpeed();

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
    public static function processResources( Village $village, int $capacity, array $production, int $time )
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
     * Processes resources
     *
     * @param   Village $v_origin
     * @param   Village $v_processed
     * @return  array
     */
    public static function processStoredResource( Village $v_origin, Village $v_processed )
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

    public static function restoreResources( Village $v_origin, Village $v_processed, Event $event )
    {
        $capacity    = $v_processed->buildings->on->warehouse->capacity;
        $resources   = self::processStoredResource( $v_origin, $v_processed );

        $stored_wood = $resources[ "wood" ] + $event->wood;
        $stored_clay = $resources[ "clay" ] + $event->clay;
        $stored_iron = $resources[ "iron" ] + $event->iron;

        if ( config( "app.env" ) == "local" )
        {
            return [
                "wood" => $stored_wood,
                "clay" => $stored_clay,
                "iron" => $stored_iron,
            ];
        }

        return [
            "wood" => ( $stored_wood <= $capacity ) ? $stored_wood : $capacity,
            "clay" => ( $stored_clay <= $capacity ) ? $stored_clay : $capacity,
            "iron" => ( $stored_iron <= $capacity ) ? $stored_iron : $capacity,
        ];
    }

    /**
     * Search building in the events
     *
     * @param   string $key
     * @param   array $events
     * @return  int
     */
    public static function searchBuildingInEvents( string $key, array $events )
    {
        $count = 0;

        foreach ( $events as $event )
            if ( $event[ "key" ] == $key )
                $count++;

        return $count;
    }

    /**
     * Get all army events
     *
     * @param   Village $v_origin
     * @param   Village $v_processed
     * @return  array
     */
    public static function getArmyEvents( Village $v_origin, Village $v_processed )
    {
        return [
            "events"  => [],
            "village" => $v_processed,
        ];
    }

    /**
     * Get all buildings events
     *
     * @param   Village $v_origin
     * @param   Village $v_processed
     * @return  array
     */
    public static function getBuildEvents( Village $v_origin, Village $v_processed )
    {
        $queue  = [];
        $events = $v_origin->buildEventsFull;
        // $events = $events->keyBy( "id" );

        foreach ( $events as $key => &$event )
        {
            $event->key           = $event->technology;
            $queue[ $event->key ] = ( !isset( $queue[ $event->key ] ) ) ? 1 : $queue[ $event->key ] + 1;

            $building             = ( property_exists( $v_processed->buildings->on, $event->key ) )
                                    ? $v_processed->buildings->on->{$event->key}
                                    : $v_processed->buildings->off->{$event->key};

            $event->name          = $building->name;
            $event->level         = $building->level + $queue[ $event->key ];

            $carbon               = Carbon::createFromFormat( "Y-m-d H:i:s", $event->finish )->toImmutable();

            if ( $carbon->isToday() )
                $event->conclusion = "Hoje às " . $carbon->format( "H:i:s" );
            else if ( $carbon->isTomorrow() )
                $event->conclusion = "Amanhã às " . $carbon->format( "H:i:s" );
            else
                $event->conclusion = $carbon->format( "d/m" ) . " às " . $carbon->format( "H:i:s" );

            $event->duration_f = gmdate( "H:i:s", $event->duration );
            $event->total_time = $event->duration;
            $event->duration   = strtotime( $event->finish ) - strtotime( Carbon::now() );

            if ( $event->duration <= 0 )
            {
                // remover da fila
                unset( $events[ $key ] );
                DB::table( "events_buildings" )->where( "event_id", $event->id )->delete();
                DB::table( "events"           )->where( "id",       $event->id )->delete();

                // atualizar edificio
                $bk                  = "building_{$building->key}";

                $v_origin->$bk      += 1;
                $v_origin->points   += ( int ) $building->points;
                $v_origin->save();

                $v_processed->$bk    = $v_origin->$bk;
                $v_processed->points = $v_origin->points;

                if ( $queue[ $event->key ] == 1 )
                    unset( $queue[ $event->key ] );
                else
                    $queue[ $event->key ] -= 1;
            }
        }

        foreach ( $queue as $key => $qtty )
        {
            $e           = $events->where( "key", $key )->last();

            $end         = $e->level + 1;
            $start       = $v_processed->buildings->on->{$key}->level;

            $v_processed = self::calculateBuildingsProps( $v_processed, $key, $start, $end );
        }

        return [
            "events"  => $events,
            "village" => $v_processed,
        ];
    }

    /**
     * Get all research events
     *
     * @param   Village $v_origin
     * @param   Village $v_processed
     * @return  array
     */
    public static function getResearchEvents( Village $v_origin, Village $v_processed )
    {
        return [
            "events"  => [],
            "village" => $v_processed,
        ];
    }

    /**
     * Get all training events
     *
     * @param   Village $v_origin
     * @param   Village $v_processed
     * @param   string  $type
     * @return  array
     */
    public static function getTrainEvents( Village $v_origin, Village $v_processed, string $type )
    {
        return [
            "events"  => [],
            "village" => $v_processed,
        ];
    }

    /**
     * Delete building event
     *
     * @param   Village $v_origin
     * @param   Village $v_processed
     * @param   Event   $event
     * @return  void
     */
    public static function cancelBuildingEvent( Village $v_origin, Village $v_processed, Event $event )
    {
        $resources                 = Helper::restoreResources( $v_origin, $v_processed, $event );
        $v_origin->stored_wood     = $resources[ "wood" ];
        $v_origin->stored_clay     = $resources[ "clay" ];
        $v_origin->stored_iron     = $resources[ "iron" ];
        $v_origin->pop            -= $event->pop;
        $v_origin->updated_stored  = now();
        $v_origin->save();

        DB::table( "events_buildings" )->where( "event_id", $event->id )->delete();
        DB::table( "events"           )->where( "id",       $event->id )->delete();
    }

    /**
     * Update building events queue
     *
     * @param   Village $village
     * @param   integer $startUpd
     * @return  void
     */
    public static function updateBuildingQueue( Village $village, int $startUpd )
    {
        $events = $village->buildEvents;

        foreach ( $events as $i => &$e )
        {
            if ( $startUpd != 0 && $i < $startUpd ) continue;

            if ( $startUpd == 0 )
            {
                $start = Carbon::now()->toImmutable();
            }
            else
            {
                $ev    = $events[ $i - 1 ];
                $start = Carbon::parse( $ev->finish )->toImmutable();
            }

            $finish    = $start->addSeconds( $e->duration );

            $e->start  = $start;
            $e->finish = $finish;
            $e->save();
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
}
