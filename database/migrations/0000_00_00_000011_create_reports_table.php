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
        // world_report
        Schema::create( "reports", function ( Blueprint $table ) {

            $table->id();
            $table->bigInteger( "user_id"         )->unsigned()->index()->foreign()->references( "id" )->on( "users"    )->onDelete( "cascade" );
            $table->bigInteger( "from_village_id" )->unsigned()->index()->foreign()->references( "id" )->on( "villages" )->onDelete( "cascade" );
            $table->bigInteger( "to_village_id"   )->unsigned()->index()->foreign()->references( "id" )->on( "villages" )->onDelete( "cascade" );
            $table->integer( "type" ); // não sei quais os tipos
            $table->boolean( "is_read" )->default( 0 );
            $table->mediumText( "data" );
            $table->timestamps();

            /**
             * types:
             * 1 ?
             * 2 ?
             * ...
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
        Schema::dropIfExists( "reports" );
    }
};
