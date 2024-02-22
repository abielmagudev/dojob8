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
        Schema::create('xapi_weatherization_product_cps_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('item_price_id');
            $table->decimal('material_price', 8, 2, true)->nullable();
            $table->decimal('labor_price', 8, 2, true)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_available')->default(true);
            $table->foreignId('category_id')->nullable()->references('id')->on('xapi_weatherization_product_cps_categories')->onDelete('set null');
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
        Schema::dropIfExists('xapi_weatherization_product_cps_products');
    }
};
