<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::namespace('Front')->as('front.')->group(function () {
    // TOP
    Route::get('/', 'TopController@index')->name('top.index');
});

/**
 * 認証
 */
Auth::routes();

Route::middleware('auth')->namespace('Front')->as('front.')->group(function () {
    /**
     * マイページ
     */
    Route::prefix('mypage')->namespace('Mypage')->as('mypage.')->group(function () {
        // マイページTOP
        Route::get('/', 'MypageController@index')->name('index');
        // プロフィール編集フォーム
        Route::get('/profile', 'MypageController@profile')->name('profile');
        // プロフィール更新処理
        Route::put('/profile', 'MypageController@updateProfile')->name('profile.update');
        // サービス管理CRUD
        Route::resource('/services', 'ServiceController', ['except' => ['show', 'destroy']]);
        // 売上一覧
        Route::get('/sales', 'SaleController@index')->name('sales.index');
        // 購入一覧
        Route::get('/buys', 'BuyController@index')->name('buys.index');
    });
    /**
     * ダイレクトメッセージ
     */
    Route::prefix('messages')->as('messages.')->group(function () {
        // 一覧
        Route::get('/', 'DirectMessageController@index')->name('index');
        // メッセージ詳細
        Route::get('/{room}', 'DirectMessageController@show')->name('show');
        // メッセージ部屋作成
        Route::post('/create', 'DirectMessageController@create')->name('create');
        // メッセージ送信
        Route::post('/{room}/send', 'DirectMessageController@send')->name('send');
        // メッセージ添付ファイルダウンロード
        Route::get('/download/{file}', 'DirectMessageController@download')->name('download');
    });

    // ユーザープロフィール
    Route::get('/users/{user}', 'UserController@show')->name('users.show');
    // フロントサービスCRUD
    Route::resource('/services', 'ServiceController', ['only' => ['index', 'show']]);
});
