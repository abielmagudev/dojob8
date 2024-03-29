<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadedMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploaded_media', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('hashed');
            $table->string('path')->index();
            // $table->string('url')->index();
            $table->string('disk');
            $table->string('type_mime');
            $table->integer('size_bytes', false, true);
            $table->integer('downloads_count', false, true)->default(0);
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
        Schema::dropIfExists('uploaded_media');
    }
}
