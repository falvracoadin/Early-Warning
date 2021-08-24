<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoNasabah;
use App\Http\Controllers\RiwayatPembayaran;
use App\Http\Controllers\EarlyWarning;


use App\Models\Nasabah;
use App\Models\Account;

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
Route::get('/test', function (){
    dump(Account::getData(0,3,'customer_identifier'));
});

//home routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login',[HomeController::class,'index'])->name('login');
Route::post('/home',[HomeController::class,'login']);

//info-nasabah/daftar-nasabah routes
Route::get('/daftar-nasabah',[InfoNasabah::class,'daftarNasabah']);

//info-nasabah/klasifikasi-nasabah routes
Route::get('/klasifikasi-nasabah',[InfoNasabah::class,'klasifikasiNasabah']);
Route::post('/klasifikasi-nasabah',[InfoNasabah::class, 'getKlasifikasiData']);

//info riwayat pembayaran
Route::get('/riwayat-pembayaran',[RiwayatPembayaran::class, 'index']);

//warning system
Route::get('/warning-system',[EarlyWarning::class,'warningView']);

//statistic warning
Route::get('/statistic-warning',[EarlyWarning::class,'statisticsView']);
Route::post('/statistic-warning',[EarlyWarning::class,'statistics']);


Route::post('/logout',[HomeController::class,'logout'])->name('logout');


Route::fallback([HomeController::class,'index']);
