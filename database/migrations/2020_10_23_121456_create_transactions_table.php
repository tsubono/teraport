<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->comment('サービスID');
            $table->foreign('service_id')->references('id')->on('services');
            $table->unsignedBigInteger('seller_user_id')->comment('売り手ユーザーID');
            $table->foreign('seller_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('buyer_user_id')->comment('利用ユーザーID');
            $table->foreign('buyer_user_id')->references('id')->on('users');
            $table->tinyInteger('status')->comment('ステータス')->nullable()->default(0);
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
        Schema::dropIfExists('transactions');
    }
}
