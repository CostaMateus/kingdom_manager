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
            if ( !isset( $building[ "level" ] ) )
            {
                $building[ "level" ] = $building[ "min_level" ];
                if ( $name == "farm" ) $building[ "level" ] = 20;
            }

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

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
        $this->helper->getVillages( $this->compact );

        $this->compact[ "village" ] = $village;

        return view( "users.player.buildings.watchtower", $this->compact );
    }

}
