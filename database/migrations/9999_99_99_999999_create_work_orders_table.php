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
            $table->date('scheduled_date')->index();
            $table->time('scheduled_time')->nullable();
            $table->string('status')->index();
            $table->text('notes')->nullable();
            $table->foreignId('client_id')->index();
            $table->foreignId('crew_id')->nullable();
            $table->foreignId('intermediary_id')->nullable();
            $table->foreignId('job_id');
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
