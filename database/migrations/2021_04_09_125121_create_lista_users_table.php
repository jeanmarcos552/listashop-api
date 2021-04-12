<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_users', function (Blueprint $table) {
            $table->integer("userId");
            $table->integer("listaId");

            $table->foreign("userId")->references("id")->on("users");
            $table->foreign("listaId")->references("id")->on("listas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lista_users');
    }
}
