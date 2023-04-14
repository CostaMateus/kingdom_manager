<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Helpers\Helper;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BuildingRequest;
use Illuminate\Support\Facades\Storage;

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
        $this->helper  = new Helper();

        $buildings     = config( "game_buildings" );
        $units         = config( "game_units"     );

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
    public function overview( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.overview", $this->compact );
    }

    /**
     * Tela edificio principal
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function main( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.main", $this->compact );
    }

    /**
     * Tela quartel
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function barracks( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.barracks", $this->compact );
    }

    /**
     * Tela estabulo
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stable( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.stable", $this->compact );
    }

    /**
     * Tela oficina
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function workshop( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.workshop", $this->compact );
    }

    /**
     * Tela forja
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function smithy( Request $request, Village $village )
    {

        $this->insertDataCompact( $request );

        return view( "users.player.buildings.smithy", $this->compact );
    }

    /**
     * Tela igreja
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function church( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.church", $this->compact );
    }

    /**
     * Tela academia
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function academy( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.academy", $this->compact );
    }

    /**
     * Tela praça de reuniao
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function place( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.place", $this->compact );
    }

    /**
     * Tela estatua
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function statue( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.statue", $this->compact );
    }

    /**
     * Tela mercado
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function market( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.market", $this->compact );
    }

    /**
     * Tela madeireira
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function wood( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.wood", $this->compact );
    }

    /**
     * Tela poço de argila
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clay( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.clay", $this->compact );
    }

    /**
     * Tela mina de ferro
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function iron( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.iron", $this->compact );
    }

    /**
     * Tela fazenda
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function farm( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.farm", $this->compact );
    }

    /**
     * Tela armazem
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function warehouse( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.warehouse", $this->compact );
    }

    /**
     * Tela esconderijo
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hide( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.hide", $this->compact );
    }

    /**
     * Tela muralha
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function wall( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.wall", $this->compact );
    }

    /**
     * Tela torre de vigia
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function watchtower( Request $request, Village $village )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.buildings.watchtower", $this->compact );
    }

    /**
     * Change the name of the village
     *
     * @param Request $request
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changeVillageName( Request $request, Village $village )
    {
        if ( $village->name != $name = $request->name )
        {
            $village->name = $name;
            $village->save();
        }

        return redirect()->back();
    }

    /**
     * Insert data in compact
     *
     * @param   Request $request
     * @return  void
     */
    private function insertDataCompact( Request $request )
    {
        if ( isset( $request->villages ) )
            $this->compact[ "villages" ] = $request->villages;

        if ( isset( $request->village ) )
            $this->compact[ "village"  ] = $request->village;

        if ( isset( $request->events ) )
            $this->compact[ "events"   ] = $request->events;
    }
}
