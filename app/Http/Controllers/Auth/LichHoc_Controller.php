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
            $listPhanCong  = PhanCong::select('phan_congs.*','mon_hocs.tenMon as tenMonHoc',
                                'users.ho as ho',
                                'users.ten as ten',
                                'table_ngay_days.name as ngayDay',
                                'tiet_hoc.tenTietHoc as tenTietHoc',
                                'phong_hocs.tenPhonghoc as tenPhongHoc'
                                )
                            ->leftJoin('lich_hocs','phan_congs.id_lichHoc', 'lich_hocs.id')
                            ->leftJoin('mon_hocs','phan_congs.id_monHoc','mon_hocs.id')
                            ->leftJoin('users', 'phan_congs.id_user_giang_vien','users.id')
                            ->leftJoin('table_ngay_days','phan_congs.id_ngayDay','table_ngay_days.id')
                            ->leftJoin('tiet_hoc','phan_congs.id_tietHoc','tiet_hoc.id')
                            ->leftJoin('phong_hocs','phan_congs.id_phongHoc','phong_hocs.id')
                            ->where('lich_hocs.id',$id_lichHoc)
                            ->get();
                            // dd($listPhanCong);
            $collection_phanCong = collect($listPhanCong);
            // dd($collection_phanCong);
            $grouped_phanCongs = $collection_phanCong->mapToGroups(function($item){
                return [$item['id_user_giang_vien']  => $item];
            })->map(function($item){
                $collect = collect($item);
                $first = $collect->first();
                return [
                    'tietHocs' => $collect->pluck('tenTietHoc')->toArray(),
                    'id_tietHocs' => $collect->pluck('id_tietHoc')->toArray(),
                    'id' => $first['id'],
                    'id_lichHoc' => $first['id_lichHoc'],
                    'id_monHoc' => $first['id_monHoc'],
                    'id_user_giang_vien' => $first['id_user_giang_vien'],
                    'id_ngayDay' => $first['id_ngayDay'],
                    'id_phongHoc' => $first['id_phongHoc'],
                    'tenMonHoc' => $first['tenMonHoc'],
                    'ho' => $first['ho'],
                    'ten' => $first['ten'],
                    'ngayDay' => $first['ngayDay'],
                    'tenPhongHoc' => $first['tenPhongHoc'],
                ];
            });
            // dd($grouped_phanCongs->toArray());
            $listMonHoc = MonHoc::where('id_KhoaHoc',$id_khoaHoc)
                        ->where('id_nganhHoc',$id_nganhHoc)
                        ->where('end_time','>',now())
                        ->get();
            $listGiangVien = User::where('role',AppUtils::ROLE_GIANG_VIEN)->get();
            $listPhongHoc = PhongHoc::all();
            $listNgayHoc = DB::table('table_ngay_days')->get();
            $listTietHoc = DB::table('tiet_hoc')->get();
            return view('user.admin_gv.lichHoc.xepLichHoc',[
                'listPhanCong' => $grouped_phanCongs->toArray(),
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

    public function lichHoc_sort_delete($id_lichHoc, $id_monHoc,$id_user_giang_vien,$id_ngayDay,$tietHocs,$id_phongHoc){
        try{
            $listTietHoc = explode('-',$tietHocs);
            DB::table('phan_congs')->where('id_lichHoc',$id_lichHoc)
            ->where('id_monHoc',$id_monHoc)
            ->where('id_user_giang_vien',$id_user_giang_vien)
            ->where('id_ngayDay',$id_ngayDay)
            ->where('id_phongHoc',$id_phongHoc)
            ->whereIn('id_tietHoc',$listTietHoc)->delete();
            return back()->with('success',__('messages.success.delete'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.delete'));
        }
    }
}
