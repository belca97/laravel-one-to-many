<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            

            //after('slug') aggiunge una nuova colonna dopo slug in ordine cronologico


            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');


            //onDelete è un parametro che puoi settare su mysql, invece di eliminare
            //tutte le righe di una determinata categoria, elimina solo la riga a cui è legato il post
            //invece di eliminare tutti i post legati ad una determinata categoria


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            

            
            $table->dropForeign('posts_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}
