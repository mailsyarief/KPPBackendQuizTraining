<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/LihatPeserta','PesertaController@LihatPeserta');
Route::post('/DaftarPeserta','PesertaController@DaftarPeserta');
Route::post('/CekPaketPeserta','PesertaController@CekPaketPeserta');
Route::post('/RequestSoal','SoalController@RequestSoal');
Route::post('/SubmitJawaban','SoalController@SubmitJawaban');
