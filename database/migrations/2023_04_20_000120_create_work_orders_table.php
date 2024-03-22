<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->foreignId('rectification_id')->nullable()->references('id')->on('work_orders')->onDelete('cascade');   
            $table->string('status');
            
            $table->date('scheduled_date')->nullable()->index();
            $table->tinyInteger('ordered', false, true)->nullable();
            $table->dateTime('working_at')->nullable()->index();
            $table->foreignId('working_id')->nullable();
            $table->dateTime('done_at')->nullable()->index();
            $table->foreignId('done_id')->nullable();
            $table->dateTime('completed_at')->nullable()->index();
            $table->foreignId('completed_id')->nullable();

            $table->string('permit_code')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('client_id');
            $table->foreignId('job_id');
            $table->foreignId('crew_id')->nullable();
            $table->foreignId('contractor_id')->nullable();
            $table->foreignId('assessment_id')->nullable()->references('id')->on('assessments')->onDelete('set null');
            
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
        Schema::dropIfExists('work_orders');
    }
}
