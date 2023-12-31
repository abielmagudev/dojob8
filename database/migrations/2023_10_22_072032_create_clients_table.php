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
            $table->string('phone_number')->index();
            $table->string('mobile_number')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('street')->index();
            $table->string('city');
            $table->string('state_code');
            $table->string('country_code');
            $table->string('zip_code')->index();
            $table->string('district_code')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
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
