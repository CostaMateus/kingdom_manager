<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Village;
use Illuminate\Http\Request;

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

        $buildings    = config( "game_buildings"   );
        $units        = config( "game_units.units" );

        foreach ( $buildings as $name => &$building )
        {
            $base = $building[ "build_time" ];
            $building[ "build_time" ] = sprintf('%02d:%02d:%02d', ( $base / 3600 ),( $base / 60 % 60 ), ( $base % 60 ) );
        }

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
        $this->getInfos( $village );

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
        $this->getInfos( $village );

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
        $this->getInfos( $village );

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
        $this->getInfos( $village );

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
        $this->getInfos( $village );

        return view( "users.player.buildings.watchtower", $this->compact );
    }


    private function getInfos( Village $village )
    {
        $this->compact[ "village" ] = $village;

        $this->helper->getVillages( $this->compact );
        $this->helper->getBuildingsLevel( $this->compact );
        $this->helper->calcBuildingsProps( $this->compact );
    }

    /**
     * Atualiza o nível do edifício
     *
     * @param Village $village
     * @param string $building
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function upgradeBuilding( Village $village, string $building )
    {
        $b_name   = $building;
        $building = $this->compact[ "buildings" ][ $building ];
        $free_pop = $this->compact[ "buildings" ][ "farm" ][ "max_pop" ] - $village->pop;

        $currLvl  = $village->{ "building_{$b_name}" };
        $maxLvl   = $building[ "max_level" ];

        if ( $currLvl < $maxLvl )
        {
            if ( $building[ "wood" ] <= $village->stored_wood &&
                 $building[ "clay" ] <= $village->stored_clay &&
                 $building[ "iron" ] <= $village->stored_iron &&
                 $building[ "pop"  ] <= $free_pop )
            {
                $village->stored_wood -= ( int ) $building[ "wood" ];
                $village->stored_clay -= ( int ) $building[ "clay" ];
                $village->stored_iron -= ( int ) $building[ "iron" ];
                $village->pop         += ( int ) $building[ "pop"  ];
                $village->{ "building_{$b_name}" } += 1;
                $village->save();
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
        $name = $request->name;

        if ( $village->name != $name )
        {
            $village->name = $name;
            $village->save();
        }

        return redirect()->route( "village.main", [ "village" => $village ] );
    }

    public function generateVillages( $user_id )
    {
        foreach ( range( 1, 150 ) as $i )
        {
            Village::create( [
                "user_id" => $user_id,
                "name"    => "{$i} Aldeia"
            ] );
        }

        return redirect()->back();
    }

}
