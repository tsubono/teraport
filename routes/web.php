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

Route::middleware(['auth', 'invalid-user'])->namespace('Front')->as('front.')->group(function () {
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
        // 売上取引一覧
        Route::get('/sales', 'SaleController@index')->name('sales.index');
        Route::get('/sales/request', 'SaleController@request')->name('sales.request');
        Route::post('/sales/request', 'SaleController@storeRequest')->name('sales.request.store');
        // 利用取引一覧
        Route::get('/buys', 'BuyController@index')->name('buys.index');
    });
    /**
     * ダイレクトメッセージ
     */
    Route::prefix('direct-messages')->as('direct-messages.')->group(function () {
        // 一覧
        Route::get('/', 'DirectMessageController@index')->name('index');
        // メッセージ部屋作成
        Route::post('/', 'DirectMessageController@store')->name('store');
        // メッセージ詳細
        Route::get('/{room}', 'DirectMessageController@show')->name('show');
        // メッセージ送信
        Route::post('/{room}/send', 'DirectMessageController@send')->name('send');
        // メッセージ添付ファイルダウンロード
        Route::get('/download/{file}', 'DirectMessageController@download')->name('download');
    });
    /**
     * 取引
     */
    Route::prefix('transactions')->as('transactions.')->group(function () {
        Route::post('/', 'TransactionController@store')->name('store');
        Route::get('/{transaction}/messages', 'TransactionController@showMessages')->name('messages.show');
        Route::post('/{transaction}/messages/send', 'TransactionController@sendMessage')->name('messages.send');
        Route::get('/download/{file}', 'TransactionController@download')->name('download');
        Route::get('/{transaction}/review', 'TransactionController@review')->name('review');
        Route::post('/{transaction}/review', 'TransactionController@storeReview')->name('review.store');
        Route::post('/{transaction}/cancel-request', 'TransactionController@cancelRequest')->name('cancel.request');
        Route::post('/{transaction}/cancel-approval', 'TransactionController@cancelApproval')->name('cancel.approval');
        Route::post('/{transaction}/cancel-disapproval', 'TransactionController@cancelDisapproval')->name('cancel.disapproval');
    });

    // ユーザープロフィール
    Route::get('/users/{user}', 'UserController@show')->name('users.show');
    Route::get('/users/{user}/reviews', 'UserController@reviews')->name('users.reviews');
    // サービス一覧・詳細
    Route::resource('/services', 'ServiceController', ['only' => ['index', 'show']]);
    // 通知
    Route::get('/notifications', 'NotificationController@index')->name('notifications.index');
    Route::post('/notifications/{notification}/read', 'NotificationController@read')->name('notifications.read');
    Route::post('/notifications/read-all', 'NotificationController@readAll')->name('notifications.read-all');
});

/**
 * 管理者用
 */
Route::middleware('auth-admin')->namespace('Admin')->as('admin.')->prefix('admin')->group(function () {
    // 売上申請
    Route::get('/sale-requests', 'SaleRequestController@index')->name('sale-requests.index');
    Route::post('/sale-requests/{saleRequest}', 'SaleRequestController@update')->name('sale-requests.update');
    // ユーザー管理
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::post('/users/toggle/{user}', 'UserController@toggleIsInvalid')->name('users.toggle');
    // サービス管理
    Route::get('/services', 'ServiceController@index')->name('services.index');
    Route::post('/services/toggle/{service}', 'ServiceController@toggleIsInvalid')->name('services.toggle');
});
