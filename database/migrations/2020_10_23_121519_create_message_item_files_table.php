<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageItemFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_item_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_item_id')->comment('メッセージ詳細ID');
            $table->foreign('message_item_id')->references('id')->on('message_items')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('file_path')->comment('画像パス');
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
        Schema::dropIfExists('message_item_files');
    }
}
