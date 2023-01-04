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
        // world_ally_invitation
        Schema::create( "alliances_invitations", function ( Blueprint $table ) {

            $table->bigInteger( "alliance_id" )->unsigned()->index()->foreign()->references( "id" )->on( "alliances" )->onDelete( "cascade" );
            $table->bigInteger( "user_id"     )->unsigned()->index()->foreign()->references( "id" )->on( "users"     )->onDelete( "cascade" );
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
        Schema::dropIfExists( "alliances_invitations" );
    }
};
