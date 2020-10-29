<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id')->comment('取引ID');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->unsignedBigInteger('from_user_id')->comment('送信元ユーザーID');
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('to_user_id')->comment('送信先ユーザーID');
            $table->foreign('to_user_id')->references('id')->on('users');
            $table->text('content')->comment('内容');
            $table->boolean('is_read')->nullable()->comment('既読フラグ');
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
        Schema::dropIfExists('transaction_messages');
    }
}
