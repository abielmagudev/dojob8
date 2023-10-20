<?php

use App\Models\Extension;
use App\Models\Job;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtensionJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extension_job', function (Blueprint $table) {
            $table->foreignId('extension_id')->references('id')->on('extensions')->onDelete('cascade');
            $table->foreignId('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->tinyInteger('tidy', false, true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extension_job');
    }
}
