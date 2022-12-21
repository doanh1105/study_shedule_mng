<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Utils\AppUtils;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Controller_GiaoVu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $giaoVu = User::where('role',AppUtils::ROLE_GIAO_VU)->first();
        return view('user.admin_gv.giaoVu.list',['userGv' => $giaoVu]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $giaoVu = User::where('role',AppUtils::ROLE_GIAO_VU)->first();
            if($giaoVu){
                return back()->with('error','Chỉ có thể thêm tối đa 1 tài khoản giáo vụ');
                return;
            }
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $username = $request->username;
            $password = $request->password;
            User::create([
                'ho' => trim($first_name),
                'ten' => trim($last_name),
                'maNguoiDung' => trim($username),
                'password' => Hash::make($password),
                'role' => AppUtils::ROLE_GIAO_VU,
            ]);

            return back()->with('success',__('messages.success.create',['attribute' => 'giáo vụ']));
        }catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.create',['attribute' => 'giáo vụ']));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            User::find($id)->update([
                'ho' => trim($first_name),
                'ten' => trim($last_name),
            ]);

            return back()->with('success',__('messages.success.update'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.update'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $userDelete = User::find($id);
            if(!$userDelete){
                return back()->with('error',__('messages.not_match',['attribute' => 'Giảng viên']));
            } else {
                $userDelete->delete();
                return back()->with('success',__('messages.success.delete'));
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.delete'));
        }
    }
}
