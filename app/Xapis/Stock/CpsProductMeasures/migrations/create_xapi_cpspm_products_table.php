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
        Schema::create('xapi_cpspm_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('name_unique');
            $table->unsignedTinyInteger('item_price_id');
            $table->decimal('material_price', 8, 2, true);
            $table->decimal('labor_price', 8, 2, true);
            $table->text('notes')->nullable();
            $table->boolean('is_available')->default(true);
            $table->foreignId('category_id');
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
        Schema::dropIfExists('xapi_cpspm_products');
    }
};
