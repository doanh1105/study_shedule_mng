<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Utils\AppUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('user.admin_gv.dashboard.dashboard');
    }

    public function user_index_view(){
        return view('user.index');
    }
}
