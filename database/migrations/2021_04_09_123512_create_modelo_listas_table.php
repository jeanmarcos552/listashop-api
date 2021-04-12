<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeloListasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelo_listas', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->integer("listaId");
            $table->timestamps();

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
        Schema::dropIfExists('modelo_listas');
    }
}
