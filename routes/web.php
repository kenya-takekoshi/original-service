<?php

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

Route::get('/', 'WelcomeController@index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    // 商品検索
    Route::resource('items', 'ItemsController', ['only' => ['create', 'show']]);
    // お気に入り登録
    Route::post('favorite', 'ItemUserController@favorite')->name('item_user.favorite');
    Route::delete('favorite', 'ItemUserController@unfavorite')->name('item_user.unfavorite');
    // マイページ
    Route::resource('users', 'UsersController', ['only' => ['show']]);
});