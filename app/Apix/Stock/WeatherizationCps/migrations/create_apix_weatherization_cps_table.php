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
        Schema::create('apix_weatherization_cps', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('item_price_id')->nullable();
            $table->decimal('material_price', 8, 2, true)->nullable();
            $table->decimal('labor_price', 8, 2, true)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_available')->default(true);
            $table->foreignId('category_id');
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
        Schema::dropIfExists('apix_weatherization_cps');
    }
};
