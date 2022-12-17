<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Http\Utils\AppUtils;
use App\Models\PhongHoc;
use Illuminate\Support\Facades\Log;

class PhongHocController extends Controller
{
    //
    public function room_list(){
        $listPhongHoc = PhongHoc::orderBy('id','desc')->paginate(AppUtils::ITEM_PER_PAGE);
        return view('user.admin_gv.phongHoc.list',['listPhongHoc' => $listPhongHoc]);
    }


    public function room_store(RoomRequest $request)
    {
        //
        try{
            $maPhongHoc = $request->maPhongHoc;
            $tenPhongHoc = $request->tenPhongHoc;
            PhongHoc::create([
                'maPhongHoc' => $maPhongHoc,
                'tenPhongHoc' => $tenPhongHoc,
            ]);

            return back()->with('success',__('messages.success.create',['attribute' => 'Phòng học']));
        }catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.create',['attribute' => 'Phòng học']));
        }
    }

    public function room_update(RoomRequest $request, $id)
    {
        //
        try{
            $tenPhongHoc = $request->tenPhongHoc;

            PhongHoc::find($id)->update([
                'tenPhongHoc' => $tenPhongHoc,
            ]);

            return back()->with('success',__('messages.success.update'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.update'));
        }
    }

    public function room_delete($id)
    {
        //
        try{
            $phongHoc = PhongHoc::find($id);
            if(!$phongHoc){
                return back()->with('error',__('messages.not_match',['attribute' => 'Phòng học']));
            } else {
                $phongHoc->delete();
                return back()->with('success',__('messages.success.delete'));
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.delete'));
        }
    }
}
