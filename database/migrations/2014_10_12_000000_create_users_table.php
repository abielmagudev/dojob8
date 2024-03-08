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
            // $table->string('email')->unique();

            /**
             * Reason why the email field is not unique.
             * 
             * If you authenticate with email, give the option to select 
             * which user profile wants to continue.
             * 
             * Also for recovery mode for any user who has this profile.
             * 
             * With the form request, we can force a user to have a unique email 
             * independent of the configuration of the user table.
             */
            $table->string('email');
            
            $table->string('password');
            $table->morphs('profile');
            $table->dateTime('last_session_at')->nullable()->index();
            $table->string('last_session_device')->nullable();
            $table->string('last_session_ip')->nullable()->index();
            $table->text('last_session_geo')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
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
