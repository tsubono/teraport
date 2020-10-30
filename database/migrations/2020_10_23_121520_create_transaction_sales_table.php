<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id')->comment('取引ID');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->unsignedBigInteger('category_id')->comment('カテゴリID');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('title')->comment('タイトル');
            $table->text('content')->comment('内容');
            $table->integer('price')->comment('金額');
            $table->text('request_for_purchase')->nullable()->comment('購入にあたってのお願い');
            $table->string('stripe_charge_id')->nullable()->comment('ストライプ決済ID');
            $table->integer('fee')->nullable()->default(0)->comment('手数料');
            $table->boolean('is_transferred')->nullable()->default(false)->comment('振り込み完了フラグ');
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
        Schema::dropIfExists('transaction_sales');
    }
}
