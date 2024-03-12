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
        Schema::create('xapi_celluloseins_work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->string('rvalue_name');
            $table->string('rvalue_score')->nullable();
            $table->float('square_footage', 8, 2, true)->nullable();
            $table->smallInteger('bags', false, true);
            $table->foreignId('work_order_id')->references('id')->on('work_orders')->onDelete('cascade')->index('xapi_celluloseins_work_order_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xapi_celluloseins_work_orders');
    }
};