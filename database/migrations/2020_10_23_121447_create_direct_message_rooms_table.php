<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectMessageRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_message_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_1_id')->comment('参加ユーザーID_1');
            $table->foreign('user_1_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_2_id')->comment('参加ユーザーID_2');
            $table->foreign('user_2_id')->references('id')->on('users');
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
        Schema::dropIfExists('direct_message_rooms');
    }
}
