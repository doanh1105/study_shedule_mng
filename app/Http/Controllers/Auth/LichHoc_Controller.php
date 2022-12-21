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
use Illuminate\Support\Facades\Auth;
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

            //check lịch học của khoá và ngành học đã tồn tại
            $lich_hoc_avalable = DB::table('lich_hocs')
                ->where('id_khoaHoc',$id_khoaHoc)
                ->where('id_nganhHoc', $id_nganhHoc)
                ->whereDate('ngayKetThuc','>=', now())
                ->get();
            if($lich_hoc_avalable->count()){
                return back()->with('error','Không thể xếp lịch học cho khoá và ngành học này bởi lịch học hiện tại chưa kết thúc.');
                return;
            }
            //

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

    public function lichHoc_delete($id){
        try{
            $lichHoc = LichHoc::find($id);
            if(!$lichHoc){
                return back()->with('error',__('messages.not_match',['attribute' => 'Lịch học']));
            } else {
                DB::transaction(function() use($lichHoc){
                    DB::table('phan_congs')->where('id_lichHoc',$lichHoc->id)->delete();
                    $lichHoc->delete();
                });
                return back()->with('success',__('messages.success.delete'));
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.delete'));
        }
    }

    public function lichHoc_sort_view($id_lichHoc, $id_nganhHoc, $id_khoaHoc){
        try{
            $lichHoc = DB::table('lich_hocs')->where('id', $id_lichHoc)->first();
            $khoaHoc = DB::table('khoa_hocs')->where('id',$id_khoaHoc)->first();
            $nganhHoc = DB::table('nganh_hoc')->where('id',$id_nganhHoc)->first();
            // dd($nganhHoc);
            if(!$lichHoc || !$khoaHoc || !$nganhHoc){
                return view('errors.404');
            }
            $listPhanCong = PhanCong::select('phan_congs.*','mon_hocs.tenMon as tenMonHoc',
                                'users.ho as ho',
                                'users.ten as ten',
                                'table_ngay_days.name as ngayDay',
                                'phong_hocs.tenPhonghoc as tenPhongHoc'
                                )
                            ->leftJoin('lich_hocs','phan_congs.id_lichHoc', 'lich_hocs.id')
                            ->leftJoin('mon_hocs','phan_congs.id_monHoc','mon_hocs.id')
                            ->leftJoin('users', 'phan_congs.id_user_giang_vien','users.id')
                            ->leftJoin('table_ngay_days','phan_congs.id_ngayDay','table_ngay_days.id')
                            ->leftJoin('phong_hocs','phan_congs.id_phongHoc','phong_hocs.id')
                            ->where('lich_hocs.id',$id_lichHoc)
                            ->get();

             foreach($listPhanCong as $phanCong){
                 $ids_tietHoc = unserialize($phanCong->ids_tietHoc);
                 $tietHocs = DB::table('tiet_hoc')
                     ->whereIn('id',$ids_tietHoc)->get();
                 $phanCong_tietHocs = [];
                 foreach ($tietHocs as $tietHoc){
                    $phanCong_tietHocs[] =  $tietHoc->tenTietHoc;
                 }
                 $phanCong->tietHocs = $phanCong_tietHocs;
             }
//             dd($listPhanCong);
            $listMonHoc = MonHoc::where('id_KhoaHoc',$id_khoaHoc)
                        ->where('id_nganhHoc',$id_nganhHoc)
                        ->where('end_time','>',now())
                        ->get();
            $listGiangVien = User::where('role',AppUtils::ROLE_GIANG_VIEN)->get();
            $listPhongHoc = PhongHoc::all();
            $listNgayHoc = DB::table('table_ngay_days')->get();
            $listTietHoc = DB::table('tiet_hoc')->get();

            return view('user.admin_gv.lichHoc.xepLichHoc',[
                'listPhanCong' => $listPhanCong,
                'listMonHoc' => $listMonHoc,
                'listGiangVien' => $listGiangVien,
                'listPhongHoc' => $listPhongHoc,
                'listNgayHoc' => $listNgayHoc,
                'listTietHoc' => $listTietHoc,
                'id_lichHoc' => $id_lichHoc,
                'lichHoc' => $lichHoc,
                'nganhHoc' => $nganhHoc,
                'khoaHoc' => $khoaHoc,
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
            $id_tietHocs = $request->id_tietHoc;

            //check trùng lịch
            $phanCong_avalable = DB::table('lich_hocs')
                ->select('phan_congs.*','khoa_hocs.tenKhoa as tenKhoaHoc'
                    ,'nganh_hoc.tenNganhHoc as tenNganhHoc','mon_hocs.tenMon as tenMonHoc')
                ->leftJoin('khoa_hocs','lich_hocs.id_khoaHoc','khoa_hocs.id')
                ->leftJoin('nganh_hoc','lich_hocs.id_nganhHoc','nganh_hoc.id')
                ->leftJoin('phan_congs','phan_congs.id_LichHoc','lich_hocs.id')
                ->leftJoin('mon_hocs','phan_congs.id_monHoc','mon_hocs.id')
                ->whereDate('ngayKetThuc','>=', now())
                ->where('phan_congs.id_phongHoc',$id_phongHoc)
                ->orWhere('phan_congs.id_user_giang_vien',$id_giangVien)
                ->where('phan_congs.id_ngayDay',$id_ngayDay)
                ->get();
//            dd($phanCong_avalable);
            foreach ($phanCong_avalable as $phanCong){
                $tietHoc_ids_arr = unserialize($phanCong->ids_tietHoc);
                $tiet_hoc_compare = array_intersect($tietHoc_ids_arr,$id_tietHocs);

                $tietHocs = DB::table('tiet_hoc')
                    ->whereIn('id',$tiet_hoc_compare)->get();
                $phanCong_tietHocs = [];
                foreach ($tietHocs as $tietHoc){
                    $phanCong_tietHocs[] =  $tietHoc->tenTietHoc;
                }
                $phanCong->tietHocs = $phanCong_tietHocs;
                Log::debug(implode(",",$phanCong->tietHocs));
                Log::debug($id_ngayDay." ".$phanCong->id_ngayDay);
                Log::debug($id_phongHoc." ".$phanCong->id_phongHoc);
                Log::debug(count($tiet_hoc_compare));
                if(
                    $id_ngayDay == $phanCong->id_ngayDay
                    && $id_phongHoc == $phanCong->id_phongHoc
                    && count($tiet_hoc_compare) > 0
                ){
                    return back()->with('error',
                        "Trùng phòng học với môn <span class='text-danger'>$phanCong->tenMonHoc</span> <br>".
                        "Khoá: <span class='text-danger'>$phanCong->tenKhoaHoc</span> <br>".
                        "Ngành học: <span class='text-danger'>$phanCong->tenNganhHoc</span>  <br>".
                        "Trùng "."<span class='text-danger'>".implode(",",$phanCong->tietHocs)."</span> "
                    );
                    return;
                }
                elseif (
                    $id_ngayDay == $phanCong->id_ngayDay
                    && $id_giangVien == $phanCong->id_user_giang_vien
                    && count($tiet_hoc_compare) > 0
                ){
                    return back()->with('error',
                        "Trùng giảng viên với môn <span class='text-danger'>$phanCong->tenMonHoc</span> <br>".
                        "Khoá: <span class='text-danger'>$phanCong->tenKhoaHoc</span> <br>".
                        "Ngành học: <span class='text-danger'>$phanCong->tenNganhHoc</span>  <br>".
                        "Trùng "."<span class='text-danger'>".implode(",",$phanCong->tietHocs)."</span> "
                    );
                    return;
                }
            }

            //

            DB::table('phan_congs')->insert([
                'id_lichHoc' => $id_lichHoc,
                'id_monHoc' => $id_monHoc,
                'id_user_giang_vien' => $id_giangVien,
                'id_phongHoc' => $id_phongHoc,
                'id_ngayDay' => $id_ngayDay,
                'ids_tietHoc' => serialize($id_tietHocs),
            ]);

            return back()->with('success',__('messages.success.create',['attribute' => 'phân công']));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.create',['attribute' => 'phân công']));
        }
    }

    public function phanCong_sort_delete($id){
        try{
            $phanCong = PhanCong::find($id);
            if(!$phanCong){
                return back()->with('error',__('messages.not_match',['attribute' => 'Phân công này đã bị xoá hoặc']));
            }
            else{
                $phanCong->delete();
                return back()->with('success',__('messages.success.delete'));
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.delete'));
        }
    }

    public function lichHoc_view($id_lichHoc,$id_nganhHoc, $id_khoaHoc){
        try{
            $lichHoc = DB::table('lich_hocs')->where('id', $id_lichHoc)->first();
            $khoaHoc = DB::table('khoa_hocs')->where('id',$id_khoaHoc)->first();
            $nganhHoc = DB::table('nganh_hoc')->where('id',$id_nganhHoc)->first();
            // dd($id_nganhHoc);
            if(!$lichHoc || !$khoaHoc || !$nganhHoc){
                return view('errors.404');
            }
            $listPhanCong = PhanCong::select('phan_congs.*','mon_hocs.tenMon as tenMonHoc',
                'users.ho as ho',
                'users.ten as ten',
                'table_ngay_days.name as ngayDay',
                'phong_hocs.tenPhonghoc as tenPhongHoc'
            )
                ->leftJoin('lich_hocs','phan_congs.id_lichHoc', 'lich_hocs.id')
                ->leftJoin('mon_hocs','phan_congs.id_monHoc','mon_hocs.id')
                ->leftJoin('users', 'phan_congs.id_user_giang_vien','users.id')
                ->leftJoin('table_ngay_days','phan_congs.id_ngayDay','table_ngay_days.id')
                ->leftJoin('phong_hocs','phan_congs.id_phongHoc','phong_hocs.id')
                ->where('lich_hocs.id',$id_lichHoc)
                ->get();

            foreach($listPhanCong as $phanCong){
                $ids_tietHoc = unserialize($phanCong->ids_tietHoc);
                $tietHocs = DB::table('tiet_hoc')
                    ->whereIn('id',$ids_tietHoc)->get();
                $phanCong_tietHocs = [];
                foreach ($tietHocs as $tietHoc){
                    $phanCong_tietHocs[] =  $tietHoc->tenTietHoc;
                }
                $phanCong->tietHocs = $phanCong_tietHocs;
            }
            return view('user.admin_gv.lichHoc.lichHoc_view',[
                'listPhanCong' => $listPhanCong,
                'lichHoc' => $lichHoc,
                'khoaHoc' => $khoaHoc,
                'nganhHoc' => $nganhHoc
            ]);
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            abort(500);
        }
    }

    public function lichHoc_view_action(){
        //
        // $user = Auth::user();
        $listLichHoc = LichHoc::select('lich_hocs.*','khoa_hocs.tenKhoa as tenKhoa','nganh_hoc.tenNganhHoc as tenNganhHoc','nganh_hoc.maNganhHoc as maNganhHoc')
                ->leftJoin('khoa_hocs', 'lich_hocs.id_khoaHoc','khoa_hocs.id')
                ->leftJoin('nganh_hoc', 'lich_hocs.id_nganhHoc','nganh_hoc.id')
                ->orderBy('lich_hocs.id', 'desc')
                ->paginate(AppUtils::ITEM_PER_PAGE);
        $listNganhHoc = DB::table('nganh_hoc')->get();
        $listKhoaHoc = DB::table('khoa_hocs')->get();
        return view('user.admin_gv.sinhVien.lichHoc_list',[
            'listLichHoc' => $listLichHoc,
            'listNganhHoc' => $listNganhHoc,
            'listKhoaHoc' => $listKhoaHoc
        ]);
    }
}
