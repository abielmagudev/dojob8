<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('lastname')->index();
            $table->string('fullname')->index();
            $table->string('street')->index();
            $table->string('zip_code')->index();
            $table->string('country_code')->index();
            $table->string('state_code')->index();
            $table->string('city')->index();
            $table->string('phone_number')->index();
            $table->string('mobile_number')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
