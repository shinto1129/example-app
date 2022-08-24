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



Auth::routes();

Route::get('/', function(){
    return view('auth.login');
});
/**
 * 共通
 */
Route::namespace('\App\Http\Controllers')
->group(function(){
});


/**
 * 教員側
 */
Route::namespace('\App\Http\Controllers')
->group(function(){
    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/calendar', 'HomeController@calendar')->name('calendar');

    Route::post('/edit', 'UserController@edit')->name('edit');
    Route::get('/delete/{id}', 'UserController@delete')->name('delete');

    Route::post('/roomRegister', 'RoomRegisterController@register')->name('roomRegister');


});

/**
 * 管理者
 */

 Route::namespace('\App\Http\Controllers\admin')
 ->name('admin.')
 ->group(function(){
    Route::get('/admin', 'HomeController@home')->name('home');
    Route::get('/admin/user', 'HomeController@user')->name('user');
    Route::get('/admin/user/{id}', 'HomeController@edit')->name('user');
    Route::get('/admin/data', 'HomeController@data')->name('data');

    //検索絞り込み
    Route::post('/admin/serch', 'HomeController@serch')->name('serch');
    Route::post('/admin/sort', 'HomeController@sort')->name('sort');
    Route::get('/admin/check', 'HomeController@check')->name('check');

    Route::get('/admin/delete/{id}', 'AdminController@delete')->name('delete');

    Route::post('/admin/edit', 'AdminController@edit')->name('edit');
    Route::post('/admin/roomEdit', 'AdminController@roomEdit')->name('roomEdit');


 });


