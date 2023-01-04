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
        // world_event_research
        Schema::create( "events_researches", function ( Blueprint $table ) {

            $table->bigInteger( "event_id" )->unsigned()->index()->foreign()->references( "id" )->on( "events" )->onDelete( "cascade" );
            $table->string( "technology" );
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
        Schema::dropIfExists( "events_researches" );
    }
};
