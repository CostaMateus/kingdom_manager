<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Village;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $compact;
    private $helper;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ( auth()->user()->is_admin )
            return view( "users.admin.home" );

        $this->compact[ "villages" ] = $this->helper->getVillages( $this->compact );

        return view( "users.player.home", $this->compact );
    }

    /**
     * Show the pending approval page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function approval()
    {
        return view( "users.player.approval" );
    }
}
