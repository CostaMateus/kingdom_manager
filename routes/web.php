<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VillageController;

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

Route::get( "/", function () {
    return view( "welcome" );
} );

Route::middleware( [ "auth" ] )->group( function () {

    Route::get( "/approval", [ HomeController::class, "approval" ] )->name( "approval" );

    Route::middleware( [ "approved" ] )->group( function () {

        Route::get( "/home",     [ HomeController::class, "index" ] )->name( "home"     );
        Route::get( "/map",      [ HomeController::class, "index" ] )->name( "map"      );
        Route::get( "/reports",  [ HomeController::class, "index" ] )->name( "reports"  );
        Route::get( "/messages", [ HomeController::class, "index" ] )->name( "messages" );
        Route::get( "/ranking",  [ HomeController::class, "index" ] )->name( "ranking"  );
        Route::get( "/alliance", [ HomeController::class, "index" ] )->name( "alliance" );
        Route::get( "/profile",  [ HomeController::class, "index" ] )->name( "profile"  );

        Route::name( "village." )->prefix( "/village/{village}/" )->group( function () {

            Route::get( "/overview",   [ VillageController::class, "overview"   ] )->name( "overview"   );

            Route::get( "/main",       [ VillageController::class, "main"       ] )->name( "main"       );
            Route::get( "/barracks",   [ VillageController::class, "barracks"   ] )->name( "barracks"   );
            Route::get( "/stable",     [ VillageController::class, "stable"     ] )->name( "stable"     );
            Route::get( "/workshop",   [ VillageController::class, "workshop"   ] )->name( "workshop"   );
            Route::get( "/smithy",     [ VillageController::class, "smithy"     ] )->name( "smithy"     );

            Route::get( "/church",     [ VillageController::class, "church"     ] )->name( "church"     );
            Route::get( "/academy",    [ VillageController::class, "academy"    ] )->name( "academy"    );
            Route::get( "/place",      [ VillageController::class, "place"      ] )->name( "place"      );
            Route::get( "/statue",     [ VillageController::class, "statue"     ] )->name( "statue"     );
            Route::get( "/market",     [ VillageController::class, "market"     ] )->name( "market"     );

            Route::get( "/wood",       [ VillageController::class, "wood"       ] )->name( "wood"       );
            Route::get( "/clay",       [ VillageController::class, "clay"       ] )->name( "clay"       );
            Route::get( "/iron",       [ VillageController::class, "iron"       ] )->name( "iron"       );

            Route::get( "/farm",       [ VillageController::class, "farm"       ] )->name( "farm"       );
            Route::get( "/warehouse",  [ VillageController::class, "warehouse"  ] )->name( "warehouse"  );
            Route::get( "/hide",       [ VillageController::class, "hide"       ] )->name( "hide"       );
            Route::get( "/wall",       [ VillageController::class, "wall"       ] )->name( "wall"       );
            Route::get( "/watchtower", [ VillageController::class, "watchtower" ] )->name( "watchtower" );

            Route::post( "/upgrade/{building}", [ VillageController::class, "upgradeBuilding"   ] )->name( "upgrade.building" );
            Route::post( "/changeName",         [ VillageController::class, "changeVillageName" ] )->name( "change.name"      );
        } );
    } );

    Route::middleware( [ "admin" ] )->group( function () {

        Route::get( "/users",                [ UserController::class, "index"   ] )->name( "admin.users.index"   );
        Route::get( "/users/{user}/approve", [ UserController::class, "approve" ] )->name( "admin.users.approve" );

    } );

} );




/**
 * /game/{villageId}/{screen}
 *
 * villageID = auto-explicativo
 * screen    = tela a ser exibida
 *
 * screen options:
 * overview   - visão geral da aldeia.
 * main       - edificio principal
 * barracks   - Quartel
 * stable     - Estábulo
 * workshop   - Oficina
 * church     - Igreja
 * academy    - Academia
 * smithy     - Forja
 * place      - Praça de reunião
 * statue     - Estátua
 * market     - Mercado
 * wood       - Bosque
 * clay       - Poço de argila
 * iron       - Mina de ferro
 * farm       - Fazenda
 * warehouse  - Armazém
 * hide       - Esconderijo
 * wall       - Muralha
 * watchtower - Torre de vigia
 *
 * map        - Mapa
 * report     - Relatórios
 * mail       - Mensagens
 *
 * ranking ally   - Classificação tribos
 * ranking player - Classificação jogadores
 *
 * ally overview  - visão geral da tribo
 *
 * info_player    - informações do jogador
 *
 */
