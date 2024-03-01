<?php

use App\Models\WorkOrder;
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
            $table->tinyInteger('ordered', false, true)->nullable();
            $table->string('status');
            $table->string('payment_status')->nullable();
            $table->string('inspection_status')->nullable();

            $table->date('scheduled_date')->nullable()->index();
            $table->dateTime('working_at')->nullable()->index();
            $table->dateTime('done_at')->nullable()->index();
            $table->dateTime('completed_at')->nullable()->index();
            $table->foreignId('working_by')->nullable();
            $table->foreignId('done_by')->nullable();
            $table->foreignId('completed_by')->nullable();

            $table->foreignId('rework_id')->nullable()->references('id')->on('work_orders')->onDelete('cascade');
            $table->foreignId('warranty_id')->nullable()->references('id')->on('work_orders')->onDelete('cascade');
            $table->foreignId('contractor_id')->nullable();
            $table->foreignId('client_id');
            $table->foreignId('crew_id')->nullable();
            $table->foreignId('job_id');

            $table->string('permit_code')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
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
