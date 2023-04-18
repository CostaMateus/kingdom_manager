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
        // world_event
        Schema::create( "events", function ( Blueprint $table ) {

            $table->id();
            $table->bigInteger( "village_id" )->unsigned()->index()->foreign()->references( "id" )->on( "villages" )->onDelete( "cascade" );
            $table->integer( "type" )->nullable()->default( null );
            $table->integer( "duration" )->nullable()->default( null );
            $table->timestamp( "start"  )->nullable()->default( null );
            $table->timestamp( "finish" )->nullable()->default( null );
            $table->timestamps();

            /**
             * types:
             * 1 construção   -> events_buildings
             * 2 recrutamento -> events_trains
             * 3 pesquisa     -> events_researchs
             * 4 exército     -> events_armies
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
        Schema::dropIfExists( "events" );
    }
};
