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

Route::get( "/", function () { return redirect( "/login" ); } );

Route::middleware( [ "auth" ] )->group( function () {

    Route::get( "/approval", [ HomeController::class, "approval" ] )->name( "approval" );

    Route::middleware( [ "isApproved" ] )->group( function () {

        Route::get( "/home",     [ HomeController::class, "index"    ] )->name( "home"     )->middleware( [ "villages.data" ] );
        Route::get( "/map",      [ HomeController::class, "map"      ] )->name( "map"      );
        Route::get( "/reports",  [ HomeController::class, "reports"  ] )->name( "reports"  );
        Route::get( "/messages", [ HomeController::class, "messages" ] )->name( "messages" );
        Route::get( "/ranking",  [ HomeController::class, "ranking"  ] )->name( "ranking"  );
        Route::get( "/alliance", [ HomeController::class, "alliance" ] )->name( "alliance" );
        Route::get( "/profile",  [ HomeController::class, "profile"  ] )->name( "profile"  );

        Route::middleware( [ "villages.user", "villages.data" ] )->name( "village." )->prefix( "/village/{village}/" )->group( function () {

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

            Route::post( "/upgrade/{building}",     [ VillageController::class, "upgradeBuilding"       ] )->name( "upgrade.building"        );
            Route::post( "/upgrade/{event}/cancel", [ VillageController::class, "cancelUpgradeBuilding" ] )->name( "cancel.upgrade.building" );
        } );

        Route::name( "village." )->prefix( "/village/{village}/" )->group( function () {

            Route::post( "/unit/train/",            [ VillageController::class, "trainUnit"             ] )->name( "train.unit"              );
            Route::post( "/unit/research/{unit}",   [ VillageController::class, "researchUnit"          ] )->name( "research.unit"           );
            Route::post( "/changeName",             [ VillageController::class, "changeVillageName"     ] )->name( "change.name"             );

        } );

    } );

    Route::middleware( [ "isAdmin" ] )->name( "admin." )->group( function () {

        Route::get( "/users",                [ UserController::class, "index"   ] )->name( "users.index"   );
        Route::get( "/users/{user}/approve", [ UserController::class, "approve" ] )->name( "users.approve" );

        Route::get( "/new/villages/{user}/{num?}", [ VillageController::class, "generateVillages" ] )->name( "generate.villages" );

    } );

    // // temporario
    // Route::get( "/new/villages/{user}/{num?}", [ VillageController::class, "generateVillages" ] )->name( "generate.villages" );

} );

Route::name( "admin." )->prefix( "/admin" )->group( function () {

    Route::get( "/clear-cache", function() {

        Artisan::call( "optimize:clear" );
        return redirect( "/" );

    } )->name( "clear.cache" );

    Route::get( "/migrate-fresh", function() {

        Artisan::call( "migrate:fresh --seed --force" );
        return redirect( "/" );

    } )->name( "migrate.fresh" );

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
