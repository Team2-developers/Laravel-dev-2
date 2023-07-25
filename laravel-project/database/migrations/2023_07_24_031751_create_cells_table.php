<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellsTable extends Migration
{
    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {
            $table->increments('cell_id');
            $table->unsignedInteger('life_id')->nullable();
            $table->foreign('life_id')->references('life_id')->on('lifes');
            $table->string('cell_detail');
            $table->integer('cell_no');
            $table->integer('cell_point')->default(0);
            $table->string('cell_color');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cells');
    }
}
