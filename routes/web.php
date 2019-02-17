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

Route::get('/', function () {return redirect('/login');});
Route::get('login', ['as' => 'login','uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => '','uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout','uses' => 'Auth\LoginController@logout']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/peserta', 'PesertaController@LihatPeserta');
    Route::get('/peserta/{id}', 'PesertaController@DetilPeserta');
    Route::get('/section', 'SectionController@LihatSection');
});
