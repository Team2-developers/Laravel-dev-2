<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLifesTable extends Migration
{
    public function up()
    {
        Schema::create('lifes', function (Blueprint $table) {
            $table->increments('life_id');
            $table->unsignedInteger('img_id')->nullable();
            $table->foreign('img_id')->references('img_id')->on('imgs');
            $table->string('life_name');
            $table->string('life_detail');
            $table->string('life_message');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->integer('good')->default(0);
            $table->integer('release')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lifes');
    }
}
