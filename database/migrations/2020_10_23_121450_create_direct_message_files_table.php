<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectMessageFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_message_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('direct_message_id')->comment('ダイレクトメッセージID');
            $table->foreign('direct_message_id')->references('id')->on('direct_messages');
            $table->string('file_path')->comment('ファイルパス');
            $table->string('file_name')->nullable()->comment('ファイル名');
            $table->timestampTz('created_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direct_message_files');
    }
}
