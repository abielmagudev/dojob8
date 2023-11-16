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
            $table->string('phone_number');
            $table->string('mobile_number')->nullable();
            $table->string('email');
            $table->string('street')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country_code', 8)->index();
            $table->string('state_code', 8)->index();
            $table->string('city')->index();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('intermediaries');
    }
}
