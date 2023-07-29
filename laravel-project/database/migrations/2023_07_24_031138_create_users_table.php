<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->unsignedInteger('img_id')->nullable();
            $table->foreign('img_id')->references('img_id')->on('imgs');
            $table->string('user_mail')->unique();
            $table->string('user_pass');
            $table->string('user_name');
            $table->integer('life_id')->nullable();
            $table->date('birth');
            $table->integer('height');
            $table->string('blood_type',20);
            $table->string('hobby');
            $table->string('episode1')->nullable();
            $table->string('episode2')->nullable();
            $table->string('episode3')->nullable();
            $table->string('episode4')->nullable();
            $table->string('episode5')->nullable();
            $table->string('abilities')->nullable();
            $table->string('token')->nullable();
            $table->date('token_deadline')->nullable();
            $table->timestamps(); //作成日、更新日を自動生成
            $table->softDeletes(); //論理削除用のカラム
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
