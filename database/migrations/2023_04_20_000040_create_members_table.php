<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('last_name')->index();
            $table->string('full_name')->index();
            $table->date('birthdate')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('mobile_number')->nullable()->index();
            $table->string('phone_number')->nullable();
            $table->string('position')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_crew_member')->default(false);
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
        Schema::dropIfExists('members');
    }
}
