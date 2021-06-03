<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_users', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('image')->nullable();
            $table->string('image_thumbnail')->nullable();

            $table->string('title');
            $table->string('short_body')->nullable();
            $table->longText('body');

            $table->dateTime('read_at')->nullable();

            $table->uuid('resource_id')->nullable();
            $table->uuid('resource_table')->nullable();

            $table->uuid('notification_id')->nullable();
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('device_token_id');
            $table->foreign('device_token_id')->references('id')->on('device_tokens')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_users');
    }
}
