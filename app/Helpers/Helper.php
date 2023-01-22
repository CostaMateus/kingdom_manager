<?php

namespace App\Helpers;

use App\Models\Village;

class Helper
{
    public function getVillages( &$arrs )
    {
        if ( !isset( $arrs[ "villages" ] ) )
        {
            $villages = Village::where( "user_id", auth()->user()->id )->get();

            foreach ( $villages as $key => &$village )
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
            }

            $arrs[ "villages" ] = $villages;
        }
    }

    public function getBuildingsLevel( &$compact )
    {
        $buildingsOn  = [];
        $buildingsOff = [];

        foreach ( $compact[ "buildings" ] as $key1 => $building )
        {
            if ( $compact[ "village" ]->{ "building_{$key1}" } != 0 || empty( $building[ "required" ] ) )
            {
                $buildingsOn[ $key1 ] = $building;
            }
            else
            {
                $toBuild = [];

                foreach ( $building[ "required" ] as $key2 => $level )
                    $toBuild[] = ( $compact[ "village" ]->{ "building_{$key2}" } >= $level ) ? true : false;

                if ( in_array( false, $toBuild ) )
                    $buildingsOff[ $key1 ] = $building;
                else
                    $buildingsOn[ $key1 ]  = $building;
            }
        }

        $compact[ "buildingsOn"  ] = $buildingsOn;
        $compact[ "buildingsOff" ] = $buildingsOff;
    }

    public function calcBuildingsProps( &$compact )
    {
        $buildings = &$compact[ "buildingsOn" ];
        $village   = &$compact[ "village"     ];

        foreach ( $buildings as $key => &$building )
        {
            $level = $village->{"building_{$key}"};

            if ( $level > 0 )
            {
                foreach ( range( 1, $level ) as $i )
                {
                    $building[ "wood"       ] = ( int ) $building[ "wood" ] * $building[ "wood_factor" ];
                    $building[ "clay"       ] = ( int ) $building[ "clay" ] * $building[ "clay_factor" ];
                    $building[ "iron"       ] = ( int ) $building[ "iron" ] * $building[ "iron_factor" ];

                    $auxPop1                  = $building[ "pop" ] * $building[ "pop_factor" ];
                    $auxPop2                  = round( $auxPop1, 0, PHP_ROUND_HALF_DOWN );
                    $auxPop3                  = $auxPop2 - round( $building[ "pop" ], 0, PHP_ROUND_HALF_DOWN );
                    $building[ "pop"        ] = ( $i == $level ) ? $auxPop3 : $auxPop1;

                    $auxPoints1               = $building[ "points" ] * $building[ "points_factor" ];
                    $auxPoints2               = round( $auxPoints1, 0, PHP_ROUND_HALF_DOWN );
                    $auxPoints3               = $auxPoints2 - round( $building[ "points" ], 0, PHP_ROUND_HALF_DOWN );
                    $building[ "points"     ] = ( $i == $level ) ? $auxPoints3 : $auxPoints1;

                    // $building[ "build_time" ] = $building[ "build_time" ] * $building[ "build_time_factor" ];

                    if ( isset( $building[ "time"       ] ) ) $building[ "time"       ] = ( int ) $building[ "time"       ] * $building[ "time_factor"       ];
                    if ( isset( $building[ "production" ] ) ) $building[ "production" ] = ( int ) $building[ "production" ] * $building[ "production_factor" ];
                    if ( isset( $building[ "max_pop"    ] ) ) $building[ "max_pop"    ] = ( int ) $building[ "max_pop"    ] * $building[ "max_pop_factor"    ];
                    if ( isset( $building[ "capacity"   ] ) ) $building[ "capacity"   ] = ( int ) $building[ "capacity"   ] * $building[ "capacity_factor"   ];
                    if ( isset( $building[ "influence"  ] ) ) $building[ "influence"  ] = ( int ) $building[ "influence"  ] * $building[ "influence_factor"  ];
                    if ( isset( $building[ "merchants"  ] ) ) $building[ "merchants"  ] = ( int ) $building[ "merchants"  ] * $building[ "merchants_factor"  ];
                    if ( isset( $building[ "range"      ] ) ) $building[ "range"      ] = ( int ) $building[ "range"      ] * $building[ "range_factor"      ];
                }
            }
        }

        $village->prod_wood = ( $village->building_wood > 0 ) ? $buildings[ "wood" ][ "production" ] : 0;
        $village->prod_clay = ( $village->building_clay > 0 ) ? $buildings[ "clay" ][ "production" ] : 0;
        $village->prod_iron = ( $village->building_iron > 0 ) ? $buildings[ "iron" ][ "production" ] : 0;
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
}
