<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Utils\AppUtils;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function teacher_list()
    {
        //
        $listUsers = User::where('role', AppUtils::ROLE_GIANG_VIEN)->paginate(AppUtils::ITEM_PER_PAGE);
        return view('user.admin_gv.giangVien.list',['listUsers' => $listUsers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function teacher_store(UserRequest $request)
    {
        //
        try{
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $username = $request->username;
            $password = $request->password;
            User::create([
                'ho' => trim($first_name),
                'ten' => trim($last_name),
                'username' => trim($username),
                'password' => Hash::make($password),
                'role' => AppUtils::ROLE_GIANG_VIEN,
            ]);

            return back()->with('success',__('messages.success.create',['attribute' => 'Giảng viên']));
        }catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.create',['attribute' => 'Giảng viên']));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function teacher_update(UserRequest $request, $id)
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
    public function teacher_delete($id)
    {
        //
        try{
            $userUpdate = User::find($id);
            if(!$userUpdate){
                return back()->with('error',__('messages.not_match',['attribute' => 'Giảng viên']));
            } else {
                $userUpdate->delete();
                return back()->with('success',__('messages.success.delete'));
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.delete'));
        }
    }
}
