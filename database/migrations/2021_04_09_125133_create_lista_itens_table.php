<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_listas', function (Blueprint $table) {
            $table->bigInteger("lista_id")->unsigned();
            $table->bigInteger("itens_id")->unsigned();

            $table->foreign("itens_id")->references("id")->on("itens");
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
        Schema::dropIfExists('lista_itens');
    }
}
