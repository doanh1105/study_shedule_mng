<?php

use App\Http\Controllers\Auth\Controller_KhoaHoc;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\AuthController;
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

Route::get('/dang-nhap',[AuthController::class,'index'])->name('login.view');
Route::post('/dang-nhap',[AuthController::class,'login'])->name('login.post');

Route::get('/dang-xuat',[AuthController::class,'logout'])->name('logout');

Route::middleware('auth.user')->name('user.')->group(function (){
    //user
    Route::get('/',[HomeController::class,'index'])->name('home');

    //admin
    Route::get('/khoa-hoc/danh-sach',[Controller_KhoaHoc::class,'index'])->name('khoaHoc.list');
    Route::post('/khoa-hoc/tao-moi',[Controller_KhoaHoc::class,'store'])->name('khoaHoc.store');
    Route::post('/khoa-hoc/{id}/update',[Controller_KhoaHoc::class,'update'])->name('khoaHoc.update');
    Route::get('/khoa-hoc/{id}/delete',[Controller_KhoaHoc::class,'destroy'])->name('khoaHoc.destroy');

});
