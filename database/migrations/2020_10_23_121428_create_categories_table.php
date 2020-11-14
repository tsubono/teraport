<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('icon_path')->comment('アイコンパス');
            $table->string('name')->comment('カテゴリ名');
        });

        DB::table('categories')->insert([
                [
                    'icon_path' => '/img/category1.png',
                    'name' => '葬儀・法事・各種供養など',
                ],
                [
                    'icon_path' => '/img/category2.png',
                    'name' => 'お墓・納骨堂・樹木葬など',
                ],
                [
                    'icon_path' => '/img/category3.png',
                    'name' => '人生・仕事・開運相談など',
                ],
                [
                    'icon_path' => '/img/category4.png',
                    'name' => 'イベント・体験修行・施設貸出情報',
                ],
                [
                    'icon_path' => '/img/category5.png',
                    'name' => '文化・芸術・教育・スポーツ指導',
                ],
                [
                    'icon_path' => '/img/category6.png',
                    'name' => 'お寺のフリーマーケット',
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
