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
    public function index( Request $request )
    {
        if ( auth()->user()->is_admin )
            return view( "users.admin.home" );

        $this->insertDataCompact( $request );

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
            $this->compact[ "village"  ] = json_decode( json_encode( $request->village ), false );
    }
}
