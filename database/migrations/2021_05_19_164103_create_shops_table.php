<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('address');
            $table->string('zalo_phone',20);
            $table->string('latitude',30);
            $table->string('longitude',30);
            $table->string('status',10)->comment('active/ inactive')->default(STATUS_ACTIVE);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['zalo_phone','status']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
