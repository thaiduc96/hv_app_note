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
            $table->uuid('id')->primary();

            $table->string('image')->nullable();
            $table->string('image_thumbnail')->nullable();

            $table->string('title');
            $table->string('short_body')->nullable();

            $table->longText('body');
            $table->boolean('is_sent')->default(false);

            $table->uuid('created_by');
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('sent_by')->nullable();
            $table->foreign('sent_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('notifications');
    }
}
