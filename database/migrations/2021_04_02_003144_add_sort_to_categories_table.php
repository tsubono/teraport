<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('sort')->nullable()->default(0)->comment('並び順');
        });

        \App\Models\Category::where('name', '葬儀・法事・各種供養など')->update([
           'name' => 'オンライン・VR法要<br>葬儀・法事・水子供養など',
            'sort' => 1
        ]);
        \App\Models\Category::where('name', '人生・仕事・開運相談など')->update([
            'name' => 'オンライン人生相談<br>仕事・恋愛・開運など',
            'sort' => 2
        ]);
        \App\Models\Category::where('name', 'お寺のフリーマーケット')->update([
            'name' => 'オンライン寺務所<br>ご朱印・お守り・お礼など',
            'sort' => 3
        ]);
        \App\Models\Category::where('name', 'イベント・体験修行・施設貸出情報')->update([
            'name' => 'オンライン講師依頼<br>イベント・セミナーなど',
            'sort' => 4
        ]);
        \App\Models\Category::where('name', 'お墓・納骨堂・樹木葬など')->update([
            'name' => 'オンライン仏事相談<br>お墓・お仏壇・お位牌など',
            'sort' => 5
        ]);
        \App\Models\Category::where('name', '文化・芸術・教育・スポーツ指導')->update([
            'name' => 'オンライン指導依頼<br>文化・教育・運動など',
            'sort' => 6
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('sort');
        });

        \App\Models\Category::where('name', 'オンライン・VR法要<br>葬儀・法事・水子供養など')->update([
            'name' => '葬儀・法事・各種供養など',
        ]);
        \App\Models\Category::where('name', 'オンライン人生相談<br>仕事・恋愛・開運など')->update([
            'name' => '人生・仕事・開運相談など',
        ]);
        \App\Models\Category::where('name', 'オンライン人生相談<br>仕事・恋愛・開運など')->update([
            'name' => 'お寺のフリーマーケット',
        ]);
        \App\Models\Category::where('name', 'オンライン講師依頼<br>イベント・セミナーなど')->update([
            'name' => 'イベント・体験修行・施設貸出情報',
        ]);
        \App\Models\Category::where('name', 'オンライン仏事相談<br>お墓・お仏壇・お位牌など')->update([
            'name' => 'お墓・納骨堂・樹木葬など',
        ]);
        \App\Models\Category::where('name', 'オンライン指導依頼<br>文化・教育・運動など')->update([
            'name' => '文化・芸術・教育・スポーツ指導',
        ]);
    }
}
