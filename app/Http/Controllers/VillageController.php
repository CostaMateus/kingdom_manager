<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\BuildingRequest;

class VillageController extends Controller
{
    private $compact;
    private $helper;

    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->helper = new Helper();

        $buildings    = config( "game_buildings" );
        $units        = config( "game_units"     );

        // foreach ( $buildings as $name => &$building )
        // {
        //     $base = $building[ "build_time" ];
        //     $building[ "build_time" ] = sprintf('%02d:%02d:%02d', ( $base / 3600 ),( $base / 60 % 60 ), ( $base % 60 ) );
        // }

        // foreach ( $units as $name => &$unit )
        // {
        //     $base = $unit[ "build_time" ];
        //     $unit[ "build_time" ] = sprintf('%02d:%02d:%02d', ( $base / 3600 ),( $base / 60 % 60 ), ( $base % 60 ) );
        // }

        $this->compact = [
            "buildings" => $buildings,
            "units"     => $units,
        ];
    }

    /**
     * Tela principal
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function overview( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.overview", $this->compact );
    }

    /**
     * Tela edificio principal
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function main( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.main", $this->compact );
    }

    /**
     * Tela quartel
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function barracks( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village   );
        $this->getUnits( "barracks" );

        return view( "users.player.buildings.barracks", $this->compact );
    }

    /**
     * Tela estabulo
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stable( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );
        $this->getUnits( "stable" );

        return view( "users.player.buildings.stable", $this->compact );
    }

    /**
     * Tela oficina
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function workshop( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village   );
        $this->getUnits( "workshop" );

        return view( "users.player.buildings.workshop", $this->compact );
    }

    /**
     * Tela forja
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function smithy( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );
        $this->getUnits( "smithy" );

        return view( "users.player.buildings.smithy", $this->compact );
    }

    /**
     * Tela igreja
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function church( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.church", $this->compact );
    }

    /**
     * Tela academia
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function academy( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.academy", $this->compact );
    }

    /**
     * Tela praça de reuniao
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function place( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.place", $this->compact );
    }

    /**
     * Tela estatua
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function statue( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.statue", $this->compact );
    }

    /**
     * Tela mercado
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function market( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.market", $this->compact );
    }

    /**
     * Tela madeireira
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function wood( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.wood", $this->compact );
    }

    /**
     * Tela poço de argila
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clay( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.clay", $this->compact );
    }

    /**
     * Tela mina de ferro
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function iron( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.iron", $this->compact );
    }

    /**
     * Tela fazendo
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function farm( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.farm", $this->compact );
    }

    /**
     * Tela armazem
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function warehouse( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.warehouse", $this->compact );
    }

    /**
     * Tela esconderijo
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hide( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.hide", $this->compact );
    }

    /**
     * Tela muralha
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function wall( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.wall", $this->compact );
    }

    /**
     * Tela torre de vigia
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function watchtower( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.watchtower", $this->compact );
    }




    /**
     * Atualiza o nível do edifício
     *
     * @param Village $village
     * @param string $unit
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function researchUnit( Village $village, string $unit )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );
        $this->getUnits( "smithy" );

        $currLvl = $village->{ "research_{$unit}" };

        $unit    = ( isset( $this->compact[ "unitsOn" ][ $unit ] ) )
                    ? $this->compact[ "unitsOn"  ][ $unit ]
                    : $this->compact[ "unitsOff" ][ $unit ];

        $maxLvl  = $unit[ "max_level" ];

        if ( $currLvl < $maxLvl )
        {
            if ( $unit[ "research_wood" ] <= $village->stored_wood &&
                 $unit[ "research_clay" ] <= $village->stored_clay &&
                 $unit[ "research_iron" ] <= $village->stored_iron )
            {
                $village->stored_wood -= ( int ) $unit[ "research_wood" ];
                $village->stored_clay -= ( int ) $unit[ "research_clay" ];
                $village->stored_iron -= ( int ) $unit[ "research_iron" ];
                $village->{ "research_{$unit[ "key" ] }" } += 1;
                $village->save();
            }
        }

        return redirect()->route( "village.smithy", [ "village" => $village ] );
    }

    public function trainUnit( Request $request, Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        dd( $request->all() );
    }

    /**
     * Atualiza o nível do edifício
     *
     * @param Village $village
     * @param string $building
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function upgradeBuilding( BuildingRequest $request, Village $village, string $building )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        $auxVlg   = $this->compact[ "village" ];

        $building = ( property_exists( $auxVlg->buildings->on, $building ) )
                    ? $auxVlg->buildings->on->$building
                    : $auxVlg->buildings->off->$building;

        $free_pop = $auxVlg->buildings->on->farm->max_pop - $auxVlg->pop;

        $currLvl  = $building->level;
        $maxLvl   = $building->max_level;

        $w        = ( int ) $building->wood == ( int ) $request->wood;
        $c        = ( int ) $building->clay == ( int ) $request->clay;
        $i        = ( int ) $building->iron == ( int ) $request->iron;
        $bw       = $building->wood <= $auxVlg->stored_wood;
        $bc       = $building->clay <= $auxVlg->stored_clay;
        $bi       = $building->iron <= $auxVlg->stored_iron;
        $bp       = $building->pop  <= $free_pop;

        if ( $currLvl < $maxLvl )
        {
            if ( $w && $c && $i && $bw && $bc && $bi && $bp )
            {
                $current_time = Carbon::now();
                $last_update  = new Carbon( $village->updated_stored );
                $time_elapsed = $current_time->diffInSeconds( $last_update );

                $capacity     = $auxVlg->buildings->on->warehouse->capacity;

                $new_wood     = $this->helper->upgradeBuildingProcessResource( $village, "wood", $capacity, $auxVlg->prod_wood, $time_elapsed );
                $new_clay     = $this->helper->upgradeBuildingProcessResource( $village, "clay", $capacity, $auxVlg->prod_clay, $time_elapsed );
                $new_iron     = $this->helper->upgradeBuildingProcessResource( $village, "iron", $capacity, $auxVlg->prod_iron, $time_elapsed );

                if ( $new_wood >= $building->wood &&
                     $new_clay >= $building->clay &&
                     $new_iron >= $building->iron )
                {
                    $village->updated_stored  = now();
                    $village->stored_wood     = $new_wood - $building->wood;
                    $village->stored_clay     = $new_clay - $building->clay;
                    $village->stored_iron     = $new_iron - $building->iron;
                    $village->pop            += ( int ) $building->pop;
                    $village->points         += ( int ) $building->points;
                    $village->{ "building_{$building->key}" } += 1;
                    $village->save();
                }
            }
        }

        return redirect()->route( "village.main", [ "village" => $village ] );
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changeVillageName( Request $request, Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        if ( $village->name != $name = $request->name )
        {
            $village->name = $name;
            $village->save();
        }

        return redirect()->route( "village.main", [ "village" => $village ] );
    }

    public function generateVillages( User $user, $num = null )
    {
        $num = ( !$num ) ? 1 : $num;

        foreach ( range( 1, $num ) as $i )
        {
            Village::create( [
                "user_id"        => $user->id,
                "name"           => "{$i} Aldeia de {$user->nickname}",
                "updated_stored" => now()
            ] );
        }

        return redirect()->back();
    }




    private function checkVillageUser( Village $village )
    {
        return ( auth()->user()->id != $village->user_id ) ? true : false;
    }

    private function getInfos( Village $village )
    {
        $this->compact[ "villages" ] = $this->helper->getVillages( $this->compact );

        foreach ( $this->compact[ "villages" ] as $v )
            if ( $v->id == $village->id )
                $this->compact[ "village"  ] = $v;
    }

    private function getUnits( string $building )
    {
        $this->helper->getUnits( $this->compact, $building );
    }
}
