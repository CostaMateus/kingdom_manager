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
        // world_event_build
        Schema::create( "events_buildings", function ( Blueprint $table ) {

            $table->bigInteger( "event_id" )->unsigned()->index()->foreign()->references( "id" )->on( "events" )->onDelete( "cascade" );
            $table->string( "technology" );
            $table->integer( "wood" );
            $table->integer( "clay" );
            $table->integer( "iron" );
            $table->integer( "pop"  );
            $table->timestamps();

        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( "events_buildings" );
    }
};
