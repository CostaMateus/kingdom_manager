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
        // world_village
        Schema::create( "villages", function ( Blueprint $table ) {

            $table->id();
            $table->bigInteger( "user_id" )->nullable()->unsigned()->index()->foreign()->references( "id" )->on( "users" )->onDelete( "cascade" );
            $table->string( "name" );
            $table->integer( "x" )->default( 0 );
            $table->integer( "y" )->default( 0 );
            $table->string( "map_sector" )->default( 0 );
            $table->integer( "points" )->default( 21 );
            $table->double( "loyalty" )->default( 100 );

            $table->double( "prod_wood" )->default( 0 );
            $table->double( "prod_clay" )->default( 0 );
            $table->double( "prod_iron" )->default( 0 );

            $table->integer( "pop" )->default( 5 );

            $table->double( "stored_wood" )->default( 600 );
            $table->double( "stored_clay" )->default( 600 );
            $table->double( "stored_iron" )->default( 600 );

            $table->integer( "building_main"       )->default( 1 );
            $table->integer( "building_barracks"   )->default( 0 );
            $table->integer( "building_stable"     )->default( 0 );
            $table->integer( "building_workshop"   )->default( 0 );
            $table->integer( "building_church"     )->default( 0 );
            $table->integer( "building_academy"    )->default( 0 );
            $table->integer( "building_smithy"     )->default( 0 );
            $table->integer( "building_place"      )->default( 0 );
            $table->integer( "building_statue"     )->default( 0 );
            $table->integer( "building_market"     )->default( 0 );
            $table->integer( "building_wood"       )->default( 0 );
            $table->integer( "building_clay"       )->default( 0 );
            $table->integer( "building_iron"       )->default( 0 );
            $table->integer( "building_farm"       )->default( 1 );
            $table->integer( "building_warehouse"  )->default( 1 );
            $table->integer( "building_hide"       )->default( 0 );
            $table->integer( "building_wall"       )->default( 0 );
            $table->integer( "building_watchtower" )->default( 0 );

            $table->integer( "research_spear"      )->default( 1 );
            $table->integer( "research_sword"      )->default( 1 );
            $table->integer( "research_axe"        )->default( 0 );
            $table->integer( "research_archer"     )->default( 0 );
            $table->integer( "research_spy"        )->default( 0 );
            $table->integer( "research_light"      )->default( 0 );
            $table->integer( "research_marcher"    )->default( 0 );
            $table->integer( "research_heavy"      )->default( 0 );
            $table->integer( "research_ram"        )->default( 0 );
            $table->integer( "research_catapult"   )->default( 0 );

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
        Schema::dropIfExists( "villages" );
    }
};
