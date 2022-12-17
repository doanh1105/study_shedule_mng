<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Utils\AppUtils;
use App\Models\LichHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LichHoc_Controller extends Controller
{
    //
    public function lichHoc_list()
    {
        //
        $listLichHoc = LichHoc::select('lich_hocs.*','khoa_hocs.tenKhoa as tenKhoa','nganh_hoc.tenNganhHoc as tenNganhHoc')
                ->leftJoin('khoa_hocs', 'lich_hocs.id_khoaHoc','khoa_hocs.id')
                ->leftJoin('nganh_hoc', 'lich_hocs.id_nganhHoc','nganh_hoc.id')
                ->orderBy('lich_hocs.id', 'desc')
                ->paginate(AppUtils::ITEM_PER_PAGE);
        $listNganhHoc = DB::table('nganh_hoc')->get();
        $listKhoaHoc = DB::table('khoa_hocs')->get();
        return view('user.admin_gv.lichHoc.list',[
            'listLichHoc' => $listLichHoc,
            'listNganhHoc' => $listNganhHoc,
            'listKhoaHoc' => $listKhoaHoc
        ]);
    }

    public function lichHoc_store(Request $request)
    {
        //
        try{
            $tenLichHoc = $request->tenLichHoc;
            $id_khoaHoc = $request->id_khoaHoc;
            $id_nganhHoc = $request->id_nganhHoc;
            $start_time = $request->start_time;
            $end_time = $request->end_time;
            LichHoc::create([
                'tenLichHoc' => $tenLichHoc,
                'id_khoaHoc' => $id_khoaHoc,
                'id_nganhHoc' => $id_nganhHoc,
                'ngayBatDau' => $start_time,
                'ngayKetThuc' => $end_time
            ]);

            return back()->with('success',__('messages.success.create',['attribute' => 'Lịch học']));
        }catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.create',['attribute' => 'Lịch học']));
        }
    }

    public function lichHoc_update(Request $request, $id)
    {
        //
        try{
            $tenLichHoc = $request->tenLichHoc;
            $start_time = $request->start_time;
            $end_time = $request->end_time;
            LichHoc::find($id)->update([
                'tenLichHoc' => $tenLichHoc,
                'ngayBatDau' => $start_time,
                'ngayKetThuc' => $end_time
            ]);

            return back()->with('success',__('messages.success.update'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.update'));
        }
    }
}
