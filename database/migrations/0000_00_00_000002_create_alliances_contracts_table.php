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
        // world_ally_contract
        Schema::create( "alliances_contracts", function ( Blueprint $table ) {

            $table->bigInteger( "source_alliance_id" )->unsigned()->index()->foreign()->references( "id" )->on( "alliances" )->onDelete( "cascade" );
            $table->bigInteger( "target_alliance_id" )->unsigned()->index()->foreign()->references( "id" )->on( "alliances" )->onDelete( "cascade" );
            $table->integer( "type" );
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
        Schema::dropIfExists( "alliances_contracts" );
    }
};
