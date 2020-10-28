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
            $table->unsignedBigInteger('service_id')->comment('サービスID')->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->unsignedBigInteger('seller_user_id')->comment('売り手ユーザーID')->nullable();
            $table->foreign('seller_user_id')->references('id')->on('users')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->unsignedBigInteger('buyer_user_id')->comment('購入ユーザーID')->nullable();
            $table->foreign('buyer_user_id')->references('id')->on('users')->onUpdate('SET NULL')->onDelete('SET NULL');
            $table->tinyInteger('status')->comment('ステータス');
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
        Schema::dropIfExists('transactions');
    }
}
