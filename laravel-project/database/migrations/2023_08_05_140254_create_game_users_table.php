<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_users', function (Blueprint $table) {
            $table->increments('game_user_id');
            $table->unsignedInteger('game_id');
            $table->unsignedInteger('user_id');
            $table->integer('score')->default(0);
            $table->integer('current_cell')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('game_id')->references('game_id')->on('games')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_users');
    }
}
