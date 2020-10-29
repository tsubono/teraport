<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('direct_message_room_id')->comment('ダイレクトメッセージルームID');
            $table->foreign('direct_message_room_id')->references('id')->on('direct_message_rooms');
            $table->unsignedBigInteger('from_user_id')->comment('送信元ユーザーID');
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('to_user_id')->comment('送信先ユーザーID');
            $table->foreign('to_user_id')->references('id')->on('users');
            $table->text('content')->comment('内容');
            $table->boolean('is_read')->nullable()->default(false)->comment('既読フラグ');
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
        Schema::dropIfExists('direct_messages');
    }
}
