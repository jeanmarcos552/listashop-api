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
            $table->integer("qty")->default(0);
            $table->float('value')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
            
            $table->foreign("itens_id")->references("id")->on("itens")->delete("cascate");
            $table->foreign("lista_id")->references("id")->on("listas")->delete("cascate");
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
