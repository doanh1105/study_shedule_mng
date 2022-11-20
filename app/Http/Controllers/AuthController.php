<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //
    public function index(){
        if(Auth::check()){
            return redirect()->route('user.home');
        }
        return view("login");
    }

    public function login(Request $request){
        try{
            $loginInfo = [
                'username' => $request->username,
                'password' => $request->password,
            ];
            if(Auth::attempt($loginInfo)){
                return redirect()->route('user.index');
            }
            else return back()->with('error',__('auth.failed'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage() . $e->getTraceAsString());
            return back()->with('error',__('auth.undefine_error'));
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.view');
    }
}
