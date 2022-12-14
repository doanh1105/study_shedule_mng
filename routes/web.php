<?php

use App\Http\Controllers\Auth\Controller_GiaoVu;
use App\Http\Controllers\Auth\Controller_KhoaHoc;
use App\Http\Controllers\Auth\Controller_MonHoc;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\LichHoc_Controller;
use App\Http\Controllers\Auth\PhongHocController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

    // only admin
    Route::middleware('role.admin')->group(function(){
        // Giáo vụ
        Route::get('/giao-vu',[Controller_GiaoVu::class,'index'])->name('giaoVu.list');
        Route::post('/giao-vu',[Controller_GiaoVu::class,'store'])->name('giaoVu.store');
        Route::post('/giao-vu/{id}/update',[Controller_GiaoVu::class,'update'])->name('giaoVu.update');
        Route::get('/giao-vu/{id}/delete',[Controller_GiaoVu::class,'destroy'])->name('giaoVu.destroy');
    });
    //

    //admin + giao_vu
    Route::middleware('role.giao_vu')->group(function(){
        // Khoá học
        Route::get('/khoa-hoc',[Controller_KhoaHoc::class,'index'])->name('khoaHoc.list');
        Route::post('/khoa-hoc',[Controller_KhoaHoc::class,'store'])->name('khoaHoc.store');
        Route::post('/khoa-hoc/{id}/update',[Controller_KhoaHoc::class,'update'])->name('khoaHoc.update');
        Route::get('/khoa-hoc/{id}/delete',[Controller_KhoaHoc::class,'destroy'])->name('khoaHoc.destroy');
        // Giảng viên
        Route::get('/giang-vien',[UserController::class,'teacher_list'])->name('giangVien.list');
        Route::post('/giang-vien',[UserController::class,'teacher_store'])->name('giangVien.store');
        Route::post('/giang-vien/{id}/update',[UserController::class,'teacher_update'])->name('giangVien.update');
        Route::get('/giang-vien/{id}/delete',[UserController::class,'teacher_delete'])->name('giangVien.delete');

        // Sinh viên
        Route::get('/sinh-vien',[UserController::class,'student_list'])->name('sinhVien.list');
        Route::post('/sinh-vien',[UserController::class,'student_store'])->name('sinhVien.store');
        Route::post('/sinh-vien/{id}/update',[UserController::class,'student_update'])->name('sinhVien.update');
        Route::get('/sinh-vien/{id}/delete',[UserController::class,'student_delete'])->name('sinhVien.delete');

        // Phòng học
        Route::get('/phong-hoc',[PhongHocController::class,'room_list'])->name('phongHoc.list');
        Route::post('/phong-hoc',[PhongHocController::class,'room_store'])->name('phongHoc.store');
        Route::post('/phong-hoc/{id}/update',[PhongHocController::class,'room_update'])->name('phongHoc.update');
        Route::get('/phong-hoc/{id}/delete',[PhongHocController::class,'room_delete'])->name('phongHoc.delete');

        // Môn học
        Route::get('/mon-hoc',[Controller_MonHoc::class,'subject_list'])->name('monHoc.list');
        Route::post('/mon-hoc',[Controller_MonHoc::class,'subject_store'])->name('monHoc.store');
        Route::post('/mon-hoc/{id}/update',[Controller_MonHoc::class,'subject_update'])->name('monHoc.update');
        Route::get('/mon-hoc/{id}/delete',[Controller_MonHoc::class,'subject_delete'])->name('monHoc.delete');

        //Lịch học
        Route::get('/lich-hoc',[LichHoc_Controller::class,'lichHoc_list'])->name('lichHoc.list');
        Route::post('/lich-hoc',[LichHoc_Controller::class,'lichHoc_store'])->name('lichHoc.store');
        Route::post('/lich-hoc/{id}/update',[LichHoc_Controller::class,'lichHoc_update'])->name('lichHoc.update');
        Route::get('/lich-hoc/{id}/delete',[LichHoc_Controller::class,'lichHoc_delete'])->name('lichHoc.delete');

        // Xếp lịch học
        Route::middleware('lichHoc.isActive')->group(function(){
            Route::get('/lich-hoc/{id_lichHoc}/{id_nganhHoc}/sort/{id_khoaHoc}',[LichHoc_Controller::class,'lichHoc_sort_view'])->name('lichHoc.sort_view');
            Route::post('/lich-hoc/{id_lichHoc}/{id_nganhHoc}/sort/{id_khoaHoc}',[LichHoc_Controller::class,'lichHoc_sort_store'])->name('lichHoc.sort_store');
            Route::get('/lich-hoc/del_sort/{id}',[LichHoc_Controller::class,'phanCong_sort_delete'])->name('phanCong.sort_delete');
        });
    });

    // Xem lịch học
    Route::get('/lich-hoc/{id_lichHoc}/{id_nganhHoc}/{id_khoaHoc}/view_action',[LichHoc_Controller::class,'lichHoc_view'])->name('lichHoc.view');

    Route::get('/lich-hoc/view_action',[LichHoc_Controller::class,'lichHoc_view_action'])->name('lichHoc.view_action');

    Route::get('/lich-hoc/{id_lichHoc}/{id_nganhHoc}/{id_khoaHoc}/teacher_view_action',[LichHoc_Controller::class,'lichHoc_teacher_view'])->name('lichHoc.teacher_view');

});
