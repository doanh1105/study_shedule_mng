<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Http\Utils\AppUtils;
use App\Models\MonHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Controller_MonHoc extends Controller
{
    //
    public function subject_list()
    {
        //
        $listMonHoc = MonHoc::leftJoin('nganh_hoc','nganh_hoc.id','mon_hocs.id_nganhHoc')
        ->leftJoin('khoa_hocs','khoa_hocs.id','mon_hocs.id_KhoaHoc')
        ->select('mon_hocs.*','nganh_hoc.tenNganhHoc as tenNganhHoc','khoa_hocs.tenKhoa as khoa')
        ->orderBy('mon_hocs.id','desc')
        ->paginate(AppUtils::ITEM_PER_PAGE);
        $listNganhHoc = DB::table('nganh_hoc')->get();
        $listKhoaHoc = DB::table('khoa_hocs')->get();
        return view('user.admin_gv.monHoc.list',[
            'listMonHoc' => $listMonHoc,
            'listNganhHoc' => $listNganhHoc,
            'listKhoaHoc' => $listKhoaHoc
        ]);
    }

    public function subject_store(Request $request)
    {
        //
        try{
            $tenMonHoc = $request->tenMonHoc;
            $maMonHoc = $request->maMonHoc;
            $id_khoaHoc = $request->id_khoaHoc;
            $id_nganhHoc = $request->id_nganhHoc;
            $start_time = $request->start_time;
            $end_time = $request->end_time;

            MonHoc::create([
                'maMon' => $maMonHoc,
                'tenMon' => $tenMonHoc,
                'id_khoaHoc' => $id_khoaHoc,
                'id_nganhHoc' => $id_nganhHoc,
                'start_time' => $start_time,
                'end_time' => $end_time
            ]);

            return back()->with('success',__('messages.success.create',['attribute' => 'Môn học']));
        }catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.create',['attribute' => 'Môn học']));
        }
    }


    public function subject_update(Request $request, $id)
    {
        //
        try{
            $tenMonHoc = $request->tenMonHoc;
            $maMonHoc = $request->maMonHoc;
            MonHoc::find($id)->update([
                'tenMon' => $tenMonHoc,
                'maMon' => $maMonHoc,
            ]);

            return back()->with('success',__('messages.success.update'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.update'));
        }
    }

    public function subject_delete($id)
    {
        //
        try{
            $subject = MonHoc::find($id);
            if(!$subject){
                return back()->with('error',__('messages.not_match',['attribute' => 'Môn học']));
            } else {
                $subject->delete();
                return back()->with('success',__('messages.success.delete'));
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.delete'));
        }
    }
}
