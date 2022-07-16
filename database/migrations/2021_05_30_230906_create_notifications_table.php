<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string("description", 100);
            $table->bigInteger("user_send")->unsigned();
            $table->bigInteger("user_receiver")->unsigned();
            $table->bigInteger("lista")->unsigned();
            $table->boolean("status")->default(0);
            $table->timestamps();

            $table->foreign("user_send")->references("id")->on("users")->cascadeOnDelete();
            $table->foreign("user_receiver")->references("id")->on("users")->cascadeOnDelete();
            $table->foreign("lista")->references("id")->on("listas")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
