<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            // $table->string('profile_name')->nullable();
            $table->morphs('profile');
            $table->dateTime('last_session_at')->nullable()->index();
            $table->string('last_session_device')->nullable();
            $table->string('last_session_ip')->nullable()->index();
            $table->text('last_session_geo_json')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_id')->nullable();
            $table->foreignId('updated_id')->nullable();
            $table->foreignId('deleted_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // mobile_number for SMS
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
