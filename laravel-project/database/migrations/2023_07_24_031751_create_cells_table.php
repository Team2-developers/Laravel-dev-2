<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateCellsTable extends Migration
{
    use SoftDeletes;

    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {
            $table->increments('cell_id');
            $table->unsignedInteger('life_id')->nullable();
            $table->foreign('life_id')->references('life_id')->on('life');
            $table->string('cell_detail', 255)->nullable(false);
            $table->integer('cell_no')->nullable(false);
            $table->integer('cell_point')->default(0);
            $table->string('cell_color', 255)->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cells');
    }
}
