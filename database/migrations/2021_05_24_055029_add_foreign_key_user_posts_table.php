<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyUserPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table)
        {
            //Creo la colonna che sarà la mia chiave esterna
            $table->unsignedBigInteger('user_id');

            //Definisco la mia chiave esterna e la correlazione fra le 2 entità
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
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
            $table->dropForeign('posts_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
