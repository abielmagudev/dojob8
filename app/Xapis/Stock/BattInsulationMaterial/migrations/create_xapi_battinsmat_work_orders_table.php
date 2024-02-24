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
        Schema::create('xapi_battinsmat_work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('space');
            $table->string('rvalue_name')->index();
            $table->string('rvalue_score')->nullable()->index();
            $table->string('size')->nullable();
            $table->enum('type', ['faced', 'unfaced']);
            $table->float('square_footage', 8, 2, true)->nullable();
            $table->float('square_footage_netting', 8, 2, true)->nullable();
            $table->foreignId('work_order_id')->references('id')->on('work_orders')->onDelete('cascade')->index('xapi_battinsmat_work_order_foreign');
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
        Schema::dropIfExists('xapi_battinsmat_work_orders');
    }
};
