<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id')->comment('メッセージID');
            $table->foreign('message_id')->references('id')->on('messages')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->unsignedBigInteger('from_user_id')->comment('送信元ユーザーID')->nullable();
            $table->foreign('from_user_id')->references('id')->on('users')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->unsignedBigInteger('to_user_id')->comment('送信先ユーザーID')->nullable();
            $table->foreign('to_user_id')->references('id')->on('users')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->text('content')->comment('内容');
            $table->boolean('is_read')->nullable()->comment('既読フラグ');
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
        Schema::dropIfExists('message_items');
    }
}
