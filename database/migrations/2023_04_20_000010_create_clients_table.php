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
            $table->string('last_name')->index();
            $table->string('full_name')->index();
            $table->string('email')->nullable()->index();
            $table->string('mobile_number')->nullable()->index();
            $table->string('phone_number')->nullable()->index();
            $table->string('street')->index();
            $table->string('city_name');
            $table->string('state_code');
            $table->string('country_code');
            $table->string('zip_code')->index();
            $table->string('district_code')->nullable()->index();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
