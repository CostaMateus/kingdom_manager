<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

        Route::get( "/home", [ HomeController::class, "index" ] )->name( "home" );

    } );

    Route::middleware( [ "admin" ] )->group( function () {

        Route::get( "/users",                [ UserController::class, "index"   ] )->name( "admin.users.index"   );
        Route::get( "/users/{user}/approve", [ UserController::class, "approve" ] )->name( "admin.users.approve" );

    } );

} );

// Route::get( "/test", [ TestController::class, "test" ] );



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
