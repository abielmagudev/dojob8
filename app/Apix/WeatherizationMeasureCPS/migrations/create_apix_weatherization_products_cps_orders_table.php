<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apix_weatherization_products_cps_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity');
            $table->foreignId('measure_id');
            $table->foreignId('order_id');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apix_weatherization_products_cps_orders');
    }
};
