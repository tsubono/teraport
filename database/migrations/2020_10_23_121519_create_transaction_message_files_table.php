<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMessageFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_message_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_message_id')->comment('取引メッセージID');
            $table->foreign('transaction_message_id')->references('id')->on('transaction_messages');
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
        Schema::dropIfExists('transaction_message_files');
    }
}
