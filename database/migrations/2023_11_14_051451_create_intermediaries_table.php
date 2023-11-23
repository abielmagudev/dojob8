<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntermediariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intermediaries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('alias', 16)->unique();
            $table->string('contact');
            $table->string('street')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country_code', 8)->index();
            $table->string('state_code', 8)->index();
            $table->string('city')->index();
            $table->string('phone_number');
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_available')->default(1);
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
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
        Schema::dropIfExists('intermediaries');
    }
}
