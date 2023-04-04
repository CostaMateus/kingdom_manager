<?php

    $url_config    = "https://br116.tribalwars.com.br/interface.php?func=get_config";
    $url_units     = "https://br116.tribalwars.com.br/interface.php?func=get_unit_info";
    $url_buildings = "https://br116.tribalwars.com.br/interface.php?func=get_building_info";

    $response      = Http::get( $url_units );

    if( !$response->successful() ) dd( $response );

    $xml          = simplexml_load_string( $response->body(), "SimpleXMLElement", LIBXML_NOCDATA );
    $json         = json_encode( $xml );

    $data         = json_decode( $json, true );

    dd( $json );
    dd ( $data );

    function calculateBuildingsProps( Village $village, string $building_key = "", int $start = 0 )
    {
        $dd = "";
        $pt = 0;
        $pp = 0;

        foreach ( $village->buildings->on as $key => &$building )
        {
            if ( !empty( $building_key ) )
                if ( $key != $building_key )
                    continue;

            if ( !in_array( $key, [ "main", "wood" ] ) ) continue;

            $print = [];

            foreach ( range( $start, $building->level ) as $i )
            {
                $building->build_time = self::getBuildTIme( $village->buildings->on->main, $building );
                $building->build_time_real *= $building->build_time_factor;

                if ( $i == 0 )
                {
                    $print[ $i ] = clone $building;
                    continue;
                }

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

                $pt += $building->points;
                $pp += $building->pop;

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

                $print[ $i ] = clone $building;
            }


            // ==============================================================================================================
            $arr  = [
                "wood", "clay", "iron", "pop", "build_time", "points", "time",
                "production", "max_pop", "capacity", "influence", "merchants", "range", "defense"
            ];

            $b     = json_decode( json_encode( config( "game_buildings" )[ $key ] ), false );

            $txts  = [ str_pad( "level", strlen( "12345678" ), " ", STR_PAD_LEFT ) ];
            // $first = [ "00 to 01" ];

            foreach ( $arr as $k )
            {
                $b->$k = ( property_exists( $b, $k ) ) ? $b->$k : "";

                if ( $k == "pop" )
                {
                    $len     = 3;
                    $txts[]  = str_pad( $k, $len, " ", STR_PAD_LEFT );
                    // $first[] = str_pad( $b->$k, $len, " ", STR_PAD_LEFT );
                    continue;
                }

                if ( $k == "time" )
                {
                    $len     = 4;
                    $txts[]  = str_pad( $k, $len, " ", STR_PAD_LEFT );
                    // $first[] = str_pad( $b->$k, $len, " ", STR_PAD_LEFT );
                    continue;
                }

                if ( in_array( $k, [ "wood", "clay", "iron", "points", "range" ] ) )
                {
                    $len     = 6;
                    $txts[]  = str_pad( $k, $len, " ", STR_PAD_LEFT );
                    // $first[] = str_pad( $b->$k, $len, " ", STR_PAD_LEFT );
                    continue;
                }

                if ( in_array( $k, [ "max_pop", "defense" ] ) )
                {
                    $len     = 7;
                    $txts[]  = str_pad( $k, $len, " ", STR_PAD_LEFT );
                    // $first[] = str_pad( $b->$k, $len, " ", STR_PAD_LEFT );
                    continue;
                }

                if ( in_array( $k, [ "build_time", "production", "capacity", "influence", "merchants" ] ) )
                {
                    $len     = 10;
                    $txts[]  = str_pad( $k, $len, " ", STR_PAD_LEFT );
                    // $first[] = str_pad( $b->$k, $len, " ", STR_PAD_LEFT );
                    continue;
                }
            }

            // ======================================
            // title
            $dd  .= strtoupper( $key )      . "\n";
            $dd  .= implode( " | ", $txts ) . " |\n";

            // // ======================================
            // // level 0
            // $dd  .= implode( " | ", $first ) . " |\n";

            foreach ( $print as $i => $b )
            {
                if ( $i == $building->max_level ) break;

                $i = $i < 10 ? "0{$i}" : $i;

                $y = $i + 1;
                $y = $y < 10 ? "0{$y}" : $y;

                $txt = [ "{$i} to {$y}" ];

                foreach ( $arr as $k )
                {
                    $b->$k = ( property_exists( $b, $k ) ) ? ( int ) $b->$k : "";

                    if ( $k == "pop" )
                    {
                        $txt[] = str_pad( $b->$k, 3, " ", STR_PAD_LEFT );
                        continue;
                    }

                    if ( $k == "time" )
                    {
                        $txt[] = str_pad( $b->$k, 4, " ", STR_PAD_LEFT );
                        continue;
                    }

                    if ( in_array( $k, [ "wood", "clay", "iron", "points", "range" ] ) )
                    {
                        $txt[] = str_pad( $b->$k, 6, " ", STR_PAD_LEFT );
                        continue;
                    }

                    if ( in_array( $k, [ "max_pop", "defense" ] ) )
                    {
                        $txt[] = str_pad( $b->$k, 7, " ", STR_PAD_LEFT );
                        continue;
                    }

                    if ( in_array( $k, [ "build_time", "production", "capacity", "influence", "merchants" ] ) )
                    {
                        $txt[] = str_pad( $b->$k, 10, " ", STR_PAD_LEFT );
                        continue;
                    }
                }

                $dd .= implode( " | ", $txt ) . " |\n";
            }

            $dd .= "===================================================";
            $dd .= "===================================================";
            $dd .= "==================================================|";
            $dd .= "\n\n\n\n\n\n\n";
        }

        dd( $pt, $pp, $dd );

        $village->prod_wood = ( ( $village->building_wood > 0 ) ? $village->buildings->on->wood->production : 0 ) * self::getResourceSpeed();
        $village->prod_clay = ( ( $village->building_clay > 0 ) ? $village->buildings->on->clay->production : 0 ) * self::getResourceSpeed();
        $village->prod_iron = ( ( $village->building_iron > 0 ) ? $village->buildings->on->iron->production : 0 ) * self::getResourceSpeed();

        return $village;
    }
