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
            $table->integer("user_id")->unsigned();
            $table->integer("lista_id")->unsigned();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("lista_id")->references("id")->on("listas");
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
