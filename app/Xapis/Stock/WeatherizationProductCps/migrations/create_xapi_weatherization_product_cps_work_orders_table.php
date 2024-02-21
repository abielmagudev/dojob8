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
        Schema::create('xapi_weatherization_product_cps_work_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity');
            $table->foreignId('product_id');
            $table->foreignId('work_order_id');
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
        Schema::dropIfExists('xapi_weatherization_product_cps_work_orders');
    }
};
