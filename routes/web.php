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
    Route::get('/', 'TopController@index')->name('top.index');
});

Auth::routes();

Route::middleware('auth')->namespace('Front')->as('front.')->group(function () {
    Route::prefix('mypage')->namespace('Mypage')->as('mypage.')->group(function () {
        Route::get('/', 'MypageController@index')->name('index');
        Route::get('/profile', 'MypageController@profile')->name('profile');
        Route::put('/profile', 'MypageController@updateProfile')->name('profile.update');
        Route::resource('/services', 'ServiceController', ['except' => ['show', 'destroy']]);
    });

    Route::get('/messages', 'MessageController@index')->name('messages');
    Route::get('/messages/{message}', 'MessageController@show')->name('messages.show');
    Route::post('/messages/{message}/send', 'MessageController@send')->name('messages.send');
    Route::post('/messages/create', 'MessageController@create')->name('messages.create');
    Route::get('/messages/download/{messageItemFile}', 'MessageController@download')->name('messages.download');
    Route::get('/users/{user}', 'UserController@show')->name('users.show');
    Route::resource('/services', 'ServiceController', ['only' => ['index', 'show']]);
});
