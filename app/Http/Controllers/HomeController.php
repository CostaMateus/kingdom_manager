<?php

namespace App\Http\Controllers;

use DB;
use App\Helpers\Helper;
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
     * Map screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function map( Request $request )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.map", $this->compact );
    }

    /**
     * Reports screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reports( Request $request )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.reports", $this->compact );
    }

    /**
     * Messages screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function messages( Request $request )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.messages", $this->compact );
    }

    /**
     * Ranking screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ranking( Request $request )
    {
        $this->insertDataCompact( $request );

        $players = DB::table( "users" )
                     ->where( "users.is_admin", 0 )
                     ->leftJoin( "villages", "villages.user_id", "users.id" )
                     ->select( "users.id", "users.nickname", DB::raw( "SUM(villages.points) as points" ), DB::raw(  "COUNT(villages.id) as villages" ) )
                     ->groupBy( "users.id" )
                     ->get();

        $this->compact[ "players" ] = $players;

        return view( "users.player.ranking", $this->compact );
    }

    /**
     * Alliance screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function alliance( Request $request )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.alliance", $this->compact );
    }

    /**
     * Profile screen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile( Request $request )
    {
        $this->insertDataCompact( $request );

        return view( "users.player.profile", $this->compact );
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
