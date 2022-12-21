<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Utils\AppUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        if($user->role == AppUtils::ROLE_ADMIN || $user->role == AppUtils::ROLE_GIAO_VU){
            return $this->admin_index_view();
        } else{
            return $this->user_index_view();
        }
    }

    public function admin_index_view(){
        $count_khoaHoc = DB::table('khoa_hocs')->get()->count();
        $count_giangVien = DB::table('users')->where('role',AppUtils::ROLE_GIANG_VIEN)->get()->count();
        $count_sinhVien = DB::table('users')->where('role',AppUtils::ROLE_SINH_VIEN)->get()->count();
        $count_phongHoc = DB::table('phong_hocs')->get()->count();
        $count_monHoc = DB::table('mon_hocs')->get()->count();
        return view('user.admin_gv.dashboard.dashboard',[
            'count_khoaHoc' => $count_khoaHoc,
            'count_giangVien' => $count_giangVien,
            'count_sinhVien' => $count_sinhVien,
            'count_phongHoc' => $count_phongHoc,
            'count_monHoc' => $count_monHoc
        ]);
    }

    public function user_index_view(){
        return view('user.index');
    }
}
