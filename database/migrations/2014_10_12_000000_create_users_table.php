<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名前');
            $table->string('email')->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('background_image_path')->nullable()->comment('背景画像パス');
            $table->string('icon_image_path')->nullable()->comment('アイコン画像パス');
            $table->text('introduction')->nullable()->comment('自己紹介');
            $table->string('job')->nullable()->comment('職業');
            $table->string('age')->nullable()->comment('年齢層');
            $table->string('gender', 10)->nullable()->comment('性別');
            $table->string('area')->nullable()->comment('活動エリア');
            $table->boolean('is_admin')->default(false)->comment('管理者フラグ');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
