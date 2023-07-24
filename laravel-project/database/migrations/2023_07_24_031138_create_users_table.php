<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateUsersTable extends Migration
{
    use SoftDeletes; //論理削除を利用

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
            $table->string('user_mail', 255)->nullable(false);
            $table->string('user_pass', 255)->nullable(false);
            $table->string('user_name', 255)->nullable(false);
            $table->unsignedInteger('life_id')->nullable();
            $table->date('birth')->nullable(false);
            $table->string('height', 255)->nullable(false);
            $table->unsignedInteger('blood_type')->nullable(false);
            $table->string('hobby', 255)->nullable(false);
            $table->string('episode1', 255)->nullable();
            $table->string('episode2', 255)->nullable();
            $table->string('episode3', 255)->nullable();
            $table->string('episode4', 255)->nullable();
            $table->string('episode5', 255)->nullable();
            $table->string('abilities', 255)->nullable();
            $table->string('token', 255)->nullable();
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
