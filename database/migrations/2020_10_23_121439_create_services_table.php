<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('category_id')->comment('カテゴリID');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('title')->comment('タイトル');
            $table->text('content')->comment('内容');
            $table->integer('price')->comment('金額');
            $table->text('request_for_purchase')->nullable()->comment('購入にあたってのお願い');
            $table->boolean('is_public')->nullable()->comment('公開フラグ');
            $table->timestampsTz();
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
        Schema::dropIfExists('services');
    }
}
