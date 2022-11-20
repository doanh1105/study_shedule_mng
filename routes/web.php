<?php

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
    Route::get('/',[HomeController::class,'index'])->name('home');
});
