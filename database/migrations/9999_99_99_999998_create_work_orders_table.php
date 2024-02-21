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
            $table->string('status')->index();
            $table->string('payment_status')->nullable()->index();
            $table->string('inspection_status')->nullable()->index();

            $table->date('scheduled_date')->nullable()->index();
            $table->dateTime('working_at')->nullable();
            $table->dateTime('done_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->foreignId('working_by')->nullable();
            $table->foreignId('done_by')->nullable();
            $table->foreignId('completed_by')->nullable();

            $table->foreignId('rework_id')->nullable();
            $table->foreignId('warranty_id')->nullable();
            $table->foreignId('client_id')->index();
            $table->foreignId('contractor_id')->nullable();
            $table->foreignId('crew_id');
            $table->foreignId('job_id');

            $table->string('permit_code')->nullable();
            $table->text('notes')->nullable();

            $table->foreignId('created_by')->nullable()->index();
            $table->foreignId('updated_by')->nullable()->index();
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
