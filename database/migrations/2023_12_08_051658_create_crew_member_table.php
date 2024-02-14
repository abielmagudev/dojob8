<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crew_member', function (Blueprint $table) {
            $table->foreignId('crew_id')->on('crews')->onDelete('cascade');
            $table->foreignId('member_id')->on('members')->onDelete('cascade');
            $table->timestamps();
            // $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crew_member');
    }
}
