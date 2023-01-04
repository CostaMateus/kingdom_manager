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
        // world_unit
        Schema::create( "armies", function ( Blueprint $table ) {

            $table->id();
            $table->bigInteger( "from_village_id" )->unsigned()->index()->foreign()->references( "id" )->on( "villages" )->onDelete( "cascade" );
            $table->bigInteger( "to_village_id"   )->unsigned()->index()->foreign()->references( "id" )->on( "villages" )->nullOnDelete( "cascade" );
            $table->integer( "spear"    )->default( 0 );
            $table->integer( "sword"    )->default( 0 );
            $table->integer( "axe"      )->default( 0 );
            $table->integer( "archer"   )->default( 0 );
            $table->integer( "spy"      )->default( 0 );
            $table->integer( "light"    )->default( 0 );
            $table->integer( "marcher"  )->default( 0 );
            $table->integer( "heavy"    )->default( 0 );
            $table->integer( "ram"      )->default( 0 );
            $table->integer( "catapult" )->default( 0 );
            $table->integer( "paladin"  )->default( 0 );
            $table->integer( "noble"    )->default( 0 );
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
        Schema::dropIfExists( "armies" );
    }
};
