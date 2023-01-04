<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // world_ally_event
        Schema::create( "alliances_events", function ( Blueprint $table ) {

            $table->bigInteger( "source_alliance_id" )->unsigned()->index()->foreign()->references( "id" )->on( "alliances" )->onDelete( "cascade" );
            $table->bigInteger( "target_alliance_id" )->unsigned()->index()->foreign()->references( "id" )->on( "alliances" )->onDelete( "cascade" );
            $table->bigInteger( "source_user_id"     )->unsigned()->index()->foreign()->references( "id" )->on( "users"     )->onDelete( "cascade" );
            $table->bigInteger( "target_user_id"     )->unsigned()->index()->foreign()->references( "id" )->on( "users"     )->onDelete( "cascade" );
            $table->integer( "type" ); // não sei quais os tipos
            $table->timestamps();

            /**
             * types:
             * 1 ?
             * 2 ?
             * ...
             */

        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( "alliances_events" );
    }
};
