<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('measurement_unit')->nullable();
            $table->string('item_price_id')->nullable();
            $table->decimal('material_price', 8, 2, true);
            $table->decimal('labor_price', 8, 2, true);
            // $table->decimal('unit_price', 8, 2, true); // material_price + labor_price
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('created_id')->nullable();
            $table->foreignId('updated_id')->nullable();
            $table->foreignId('deleted_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
