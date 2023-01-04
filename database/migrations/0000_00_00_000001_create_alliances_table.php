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
        // world_ally
        Schema::create( "alliances", function ( Blueprint $table ) {

            $table->id();
            $table->string( "name", "50" );
            $table->string( "tag", "6" )->unique();
            $table->boolean( "allowapply" )->default( 0 );
            $table->string( "desc" )->default( "" );
            $table->integer( "cached_points" )->default( 0 );
            $table->integer( "cached_rank" )->default( 0 );
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
        Schema::dropIfExists( "alliances" );
    }
};
