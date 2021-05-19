<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserForgotPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_forgot_passwords', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code',20);
            $table->string('target')->comment('email or phone sent');
            $table->string('sending_method')->comment('email,sms');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('expired_at');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['code','target','sending_method']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_forgot_passwords');
    }
}
