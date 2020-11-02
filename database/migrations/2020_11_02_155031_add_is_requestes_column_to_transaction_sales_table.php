<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRequestesColumnToTransactionSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_sales', function (Blueprint $table) {
            $table->unsignedBigInteger('sale_request_id')->nullable()->comment('振り込み申請ID')->after('is_transferred');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_sales', function (Blueprint $table) {
            $table->dropColumn('sale_request_id');
        });
    }
}
