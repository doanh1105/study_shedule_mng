<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Utils\AppUtils;
use App\Models\LichHoc;
use App\Models\MonHoc;
use App\Models\PhanCong;
use App\Models\PhongHoc;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LichHoc_Controller extends Controller
{
    //
    public function lichHoc_list()
    {
        //
        $listLichHoc = LichHoc::select('lich_hocs.*','khoa_hocs.tenKhoa as tenKhoa','nganh_hoc.tenNganhHoc as tenNganhHoc','nganh_hoc.maNganhHoc as maNganhHoc')
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

    public function lichHoc_sort_view($id_lichHoc, $id_nganhHoc, $id_khoaHoc){
        try{
            $listMonHoc = MonHoc::where('id_KhoaHoc',$id_khoaHoc)
                        ->where('id_nganhHoc',$id_nganhHoc)
                        ->get();
            $listGiangVien = User::where('role',AppUtils::ROLE_GIANG_VIEN)->get();
            $listPhongHoc = PhongHoc::all();
            $listNgayHoc = DB::table('table_ngay_days')->get();
            $listTietHoc = DB::table('tiet_hoc')->get();
            return view('user.admin_gv.lichHoc.xepLichHoc',[
                'listMonHoc' => $listMonHoc,
                'listGiangVien' => $listGiangVien,
                'listPhongHoc' => $listPhongHoc,
                'listNgayHoc' => $listNgayHoc,
                'listTietHoc' => $listTietHoc,
                'id_lichHoc' => $id_lichHoc
            ]);
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            abort(500);
        }
    }

    public function lichHoc_sort_store(Request $request){
        try{
            $id_lichHoc = $request->id_lichHoc;
            $id_monHoc = $request->id_monHoc;
            $id_giangVien = $request->id_giangVien;
            $id_phongHoc = $request->id_phongHoc;
            $id_ngayDay = $request->id_ngayDay;
            $id_tietHoc = $request->id_tietHoc;

            DB::beginTransaction();
            foreach($id_tietHoc as $tietHoc){
                DB::table('phan_congs')->insert([
                    'id_lichHoc' => $id_lichHoc,
                    'id_monHoc' => $id_monHoc,
                    'id_user_giang_vien' => $id_giangVien,
                    'id_phongHoc' => $id_phongHoc,
                    'id_ngayDay' => $id_ngayDay,
                    'id_tietHoc' => $tietHoc,
                ]);
            }
            DB::commit();
            return back()->with('success',__('messages.success.create',['attribute' => 'phân công']));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            DB::rollBack();
            return back()->with('error',__('messages.fails.create',['attribute' => 'phân công']));
        }
    }
}
