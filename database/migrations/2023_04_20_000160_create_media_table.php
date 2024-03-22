<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('name_hashed')->index();
            $table->string('extension', 8)->index();
            $table->string('directory');
            $table->string('disk', 64);
            $table->text('path');
            $table->text('url')->nullable();
            $table->text('original_information_json');
            $table->integer('downloads_count', false, true)->nullable();
            $table->morphs('mediable');
            $table->foreignId('created_id')->nullable();
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
        Schema::dropIfExists('media');
    }
}
