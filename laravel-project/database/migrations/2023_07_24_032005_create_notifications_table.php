<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateNotificationsTable extends Migration
{
    use SoftDeletes;

    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('notification_id');
            $table->string('notification_message');
            $table->unsignedInteger('notification_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
