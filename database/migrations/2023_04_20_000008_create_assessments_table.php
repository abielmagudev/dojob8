<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->date('scheduled_date')->index();
            $table->tinyInteger('ordered', false, true)->nullable();
            $table->string('status')->index();
            $table->text('notes')->nullable();
            $table->boolean('is_walk_thru')->default(false);
            $table->foreignId('client_id');
            $table->foreignId('contractor_id')->nullable();
            $table->foreignId('crew_id')->nullable();
            $table->foreignId('created_id')->nullable();
            $table->foreignId('updated_id')->nullable();
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
        Schema::dropIfExists('assessments');
    }
}
