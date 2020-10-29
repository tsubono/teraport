<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id')->comment('取引ID');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->unsignedBigInteger('from_user_id')->comment('評価元ユーザーID');
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('to_user_id')->comment('評価先ユーザーID');
            $table->foreign('to_user_id')->references('id')->on('users');
            $table->text('content')->comment('内容');
            $table->integer('rate')->comment('評価点');
            $table->boolean('is_public')->nullable()->default(true)->comment('公開フラグ');
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
        Schema::dropIfExists('transaction_reviews');
    }
}
