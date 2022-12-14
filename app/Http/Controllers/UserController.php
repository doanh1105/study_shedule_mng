<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiangVienRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Utils\AppUtils;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $listUsers = User::where('role', AppUtils::ROLE_GIANG_VIEN)
                    ->orderBy('users.id','desc')
                    ->paginate(AppUtils::ITEM_PER_PAGE);
        return view('user.admin_gv.giangVien.list',['listUsers' => $listUsers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function teacher_store(GiangVienRequest $request)
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
                'maNguoiDung' => trim($username),
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
    public function teacher_update(GiangVienRequest $request, $id)
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


    public function student_list()
    {
        //
        $listUsers = User::leftJoin('nganh_hoc','nganh_hoc.id','users.id_nganhHoc')
        ->select('users.*','nganh_hoc.tenNganhHoc as tenNganhHoc')
        ->where('role', AppUtils::ROLE_SINH_VIEN)
        ->orderBy('users.id','desc')
        ->paginate(AppUtils::ITEM_PER_PAGE);
        $listNganhHoc = DB::table('nganh_hoc')->get();
        return view('user.admin_gv.sinhVien.list',['listUsers' => $listUsers,'listNganhHoc' => $listNganhHoc]);
    }

    public function student_store(StudentRequest $request)
    {
        //
        try{
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $username = $request->username;
            $password = $request->password;
            $id_nganhHoc = $request->get('maNganhDaoTao');
            User::create([
                'ho' => trim($first_name),
                'ten' => trim($last_name),
                'maNguoiDung' => trim($username),
                'password' => Hash::make($password),
                'role' => AppUtils::ROLE_SINH_VIEN,
                'id_nganhHoc' => $id_nganhHoc,
            ]);

            return back()->with('success',__('messages.success.create',['attribute' => 'Sinh viên']));
        }catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.create',['attribute' => 'Sinh viên']));
        }
    }

    public function student_update(StudentRequest $request, $id)
    {
        //
        try{
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $id_nganhHoc = $request->get('maNganhDaoTao');
            User::find($id)->update([
                'ho' => trim($first_name),
                'ten' => trim($last_name),
                'id_nganhHoc' => $id_nganhHoc,
            ]);

            return back()->with('success',__('messages.success.update'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.update'));
        }
    }

    public function student_delete($id)
    {
        //
        try{
            $userDelete = User::find($id);
            if(!$userDelete){
                return back()->with('error',__('messages.not_match',['attribute' => 'Sinh viên']));
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
