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
        // world_event_train
        Schema::create( "events_trains", function ( Blueprint $table ) {

            $table->bigInteger( "event_id" )->unsigned()->index()->foreign()->references( "id" )->on( "events" )->onDelete( "cascade" );
            $table->boolean( "decommission" )->default( 0 );
            $table->string( "unit" );
            $table->integer( "amount" );
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
        Schema::dropIfExists( "events_trains" );
    }
};
