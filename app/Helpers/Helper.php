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

}
