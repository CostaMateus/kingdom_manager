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
        // user and world_user
        Schema::create( "users", function ( Blueprint $table ) {

            $table->id();
            $table->string( "name" );
            $table->string( "email" )->unique();
            $table->string( "password" );
            $table->string( "sex" )->default( "U" ); // Male, Female, Undefined
            $table->boolean( "is_banned" )->default( 0 );
            $table->boolean( "is_admin" )->default( 0 );
            $table->string( "ip" );
            $table->bigInteger( "alliance_id" )->default( 0 )->nullable()->unsigned()->index()->foreign()->references( "id" )->on( "alliances" )->nullOnDelete();
            $table->integer( "cached_points" )->default( 0 );
            $table->integer( "cached_rank" )->default( 0 );
            $table->integer( "cached_villages" )->default( 0 );
            $table->timestamp( "email_verified_at" )->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists( "users" );
    }
};
