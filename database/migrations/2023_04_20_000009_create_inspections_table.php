<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->date('scheduled_date')->nullable()->index();
            $table->string('inspector_name')->nullable()->index();
            $table->text('observations')->nullable();
            $table->string('status');
            $table->foreignId('agency_id');
            $table->foreignId('crew_id')->nullable();
            $table->foreignId('work_order_id')->references('id')->on('work_orders')->onDelete('cascade');
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
        Schema::dropIfExists('inspections');
    }
}
