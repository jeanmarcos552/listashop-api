<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsLista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listas', function (Blueprint $table) {
            $table->bigInteger('created_by')->after('ativo');
            $table->bigInteger('category_id')->unsigned()->nullable("");

            $table->foreign("category_id")->references("id")->on("categories")->delete("cascate");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listas', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('category_id');
        });
    }
}
