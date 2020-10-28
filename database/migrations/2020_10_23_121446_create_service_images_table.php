<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->comment('サービスID');
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('image_path')->nullable()->comment('画像パス');
            $table->integer('sort')->nullable()->comment('順番');
            $table->timestampTz('created_at', 0)->nullable();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_images');
    }
}
