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


Route::namespace('\App\Http\Controllers')
->group(function(){
    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/calendar', 'HomeController@calendar')->name('calendar');

    Route::post('/edit', 'UserController@edit')->name('edit');
    Route::post('/roomRegister', 'RoomRegisterController@register')->name('roomRegister');
});
