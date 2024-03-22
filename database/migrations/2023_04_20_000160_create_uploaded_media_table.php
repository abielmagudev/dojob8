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
        Schema::create('uploaded_media', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->text('url')->index();
            $table->string('disk');
            $table->string('mime');
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
