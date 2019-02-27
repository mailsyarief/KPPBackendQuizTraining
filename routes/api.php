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

Route::get('/getsection','PesertaController@GetSectionPeserta');
Route::post('/daftarpeserta','PesertaController@DaftarPeserta');

Route::post('/cekpaketpeserta','PesertaController@CekPaketPeserta');
Route::get('/cekkoneksi','PesertaController@CekKoneksi');

Route::post('/requestsoal','PesertaController@RequestSoal');
Route::post('/submitjawaban','PesertaController@SubmitJawaban');

Route::post('/remedial','PesertaController@Remedial');
Route::post('/selesaiujian','PesertaController@SelesaiUjian');

Route::post('/pembahasanpilgan','PesertaController@PembahasanPilihanGanda');
Route::post('/pembahasanmencocokan','PesertaController@PembahasanMencocokan');
Route::post('/pembahasanbenarsalah','PesertaController@PembahasanBenarSalah');
