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
        Schema::create('lista_itens', function (Blueprint $table) {
            $table->integer("listaId")->unsigned();
            $table->integer("itemId")->unsigned();

            $table->foreign("itemId")->references("id")->on("itens");
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
        Schema::dropIfExists('lista_itens');
    }
}
