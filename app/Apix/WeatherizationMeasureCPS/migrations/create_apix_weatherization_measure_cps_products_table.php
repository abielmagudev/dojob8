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
        Schema::create('apix_weatherization_measure_cps_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('wm_cps_name');
            $table->unsignedTinyInteger('item_price_id');
            $table->decimal('material_price', 8, 2, true)->nullable();
            $table->decimal('labor_price', 8, 2, true)->nullable();
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
        Schema::dropIfExists('apix_weatherization_measure_cps_products');
    }
};
