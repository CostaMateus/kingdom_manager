<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get( '/', function () {
    // return view( 'welcome' );

    // $url_config    = "https://br116.tribalwars.com.br/interface.php?func=get_config";
    // $url_units     = "https://br116.tribalwars.com.br/interface.php?func=get_unit_info";
    // $url_buildings = "https://br116.tribalwars.com.br/interface.php?func=get_building_info";

    // $response      = Http::get( $url_units );

    // if( !$response->successful() ) dd( $response );

    // $xml          = simplexml_load_string( $response->body(), "SimpleXMLElement", LIBXML_NOCDATA );
    // $json         = json_encode( $xml );

    // $data         = json_decode( $json, true );

    // dd( $json );
    // // dd ( $data );



    // // calc TIME_FACTOR
    // $base = 95;
    // $rate = -0.049;
    // $time = [ $base ];
    // // echo "1 __ $base __ 0<br>";

    // foreach ( range( 2, 30 ) as $i )
    // {
    //     $cal    = $base * $rate;
    //     $base   = $base + round( $cal, 0, PHP_ROUND_HALF_DOWN );
    //     $time[] = $base;
    //     // echo "$i __ $base __ $cal<br>";
    // }


    // // calc BUILDING_TIME
    // $base  = 563;
    // $rate  = 1.2;

    // foreach ( range( 1, 30 ) as $i )
    // {
    //     $cal = 0;

    //     if ( $i > 1 )
    //     {
    //         $cal  = ( $base * $rate );
    //         $base = round( $cal, 0, PHP_ROUND_HALF_DOWN );
    //     }

    //     $perc  = 100 - $time[ $i - 1 ];
    //     $base2 = $base - ( ( $base * $perc ) / 100 );
    //     // $base2 = $base;

    //     $aux   = sprintf('%02d:%02d:%02d', ( $base2 / 3600 ),( $base2 / 60 % 60 ), ( $base2 % 60 ) );
    //     echo "lvl $i __ $aux <br>";
    // }



    // echo "<br><br><br>";
    // $base = 10;
    // $rate = 1.22;
    // $cal  = 0;

    // echo "0 __ $base __ $cal<br>";

    // foreach ( range( 2, 3 ) as $i )
    // {
    //     $cal  = $base * $rate;
    //     $base = $cal;
    //     $base2 = round( $cal, 0, PHP_ROUND_HALF_DOWN );
    //     echo "$i __ $base2 __ $cal<br>";

    //     // $cal  = $base * $rate;
    //     // $base = round( $cal, 0, PHP_ROUND_HALF_DOWN );
    //     // echo "$i __ $base __ $cal<br>";

    //     // $cal  = $base * $rate;
    //     // $base = round( $cal, 0, PHP_ROUND_HALF_DOWN );

    //     // $aux  = sprintf('%02d:%02d:%02d', ( $base / 3600 ),( $base / 60 % 60 ), ( $base % 60 ) );
    //     // echo "$i __ $aux __ $cal<br>";
    // }












    // ================================
    // TROPAS

    // ataque
    echo "<br><br><br>";
    echo "wood<br>";
    $base = 90;
    $rate = 1.25;
    $cal  = 0;
    echo "0 __ $base __ $cal<br>";
    foreach ( range( 2, 3 ) as $i )
    {
        $cal  = $base * $rate;
        $base = $cal;
        $base2 = round( $cal, 0, PHP_ROUND_HALF_DOWN );
        echo "$i __ $base2 __ $cal<br>";
    }

    // defesa
    echo "<br><br><br>";
    echo "clay<br>";
    $base = 1;
    $rate = 1.25;
    $cal  = 0;
    echo "0 __ $base __ $cal<br>";
    foreach ( range( 2, 3 ) as $i )
    {
        $cal  = $base * $rate;
        $base = $cal;
        $base2 = round( $cal, 0, PHP_ROUND_HALF_DOWN );
        echo "$i __ $base2 __ $cal<br>";
    }


    // defesa cavalaria
    echo "<br><br><br>";
    echo "iron<br>";
    $base = 2;
    $rate = 1.25;
    $cal  = 0;
    echo "0 __ $base __ $cal<br>";
    foreach ( range( 2, 3 ) as $i )
    {
        $cal  = $base * $rate;
        $base = $cal;
        $base2 = round( $cal, 0, PHP_ROUND_HALF_DOWN );
        echo "$i __ $base2 __ $cal<br>";
    }


} );

Route::get( '/home', [ HomeController::class, 'index' ] )->name( 'home' );

/**
 *
 */
