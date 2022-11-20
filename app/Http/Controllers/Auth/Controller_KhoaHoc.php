<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Utils\AppUtils;
use App\Models\KhoaHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Controller_KhoaHoc extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_khoaHoc = KhoaHoc::select('khoa_hocs.*',
            DB::raw('COUNT(mon_hocs.id) as so_mon_hoc'),
            DB::raw('COUNT(users.id) as so_luong_sinh_vien')
            )
            ->leftJoin('mon_hocs','khoa_hocs.id','mon_hocs.id_khoaHoc')
            ->leftJoin('users','khoa_hocs.id','users.id_khoaHoc')
            ->groupBy('khoa_hocs.id')
            ->paginate(AppUtils::ITEM_PER_PAGE);
        return view('user.admin_gv.khoaHoc.list',['list_khoaHoc' => $list_khoaHoc]);
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
            $khoaHoc_new = [
                'tenKhoa' => $request->tenKhoaHoc,
            ];
            KhoaHoc::create($khoaHoc_new);

            return back()->with('success',__('messages.khoaHoc.create.success'));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.khoaHoc.create.fails'));
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
    }
}
