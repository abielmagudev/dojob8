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
        Schema::create('xapi_wzprodcps_work_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity');
            $table->string('indications')->nullable();
            $table->foreignId('product_id')->references('id')->on('xapi_wzprodcps_products')->onDelete('cascade');
            $table->foreignId('work_order_id')->references('id')->on('work_orders')->onDelete('cascade')->index('xapi_wzprodcps_work_order_foreign');
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
        Schema::dropIfExists('xapi_wzprodcps_work_orders');
    }
};
