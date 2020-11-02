<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('price')->comment('金額');
            $table->date('transfer_limit_date')->comment('振り込み期限日');
            $table->string('bank_name')->comment('銀行名');
            $table->string('branch_name')->comment('支店名');
            $table->string('bank_number')->comment('口座番号');
            $table->string('account_holder')->comment('口座名義');
            $table->text('admin_note')->nullable()->comment('管理者用備考');
            $table->boolean('status')->nullable()->default(false)->comment('ステータス');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_requests');
    }
}
