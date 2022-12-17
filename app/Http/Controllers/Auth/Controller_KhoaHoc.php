<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\KhoaHocRequest;
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
        $list_khoaHoc = KhoaHoc::orderBy('id','desc')
            ->paginate(AppUtils::ITEM_PER_PAGE);
        return view('user.admin_gv.khoaHoc.list',['list_khoaHoc' => $list_khoaHoc]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KhoaHocRequest $request)
    {
        //
        try{
            $khoaHoc_new = [
                'tenKhoa' => trim($request->tenKhoaHoc),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ];
            KhoaHoc::create($khoaHoc_new);

            return back()->with('success',__('messages.success.create',['attribute' => 'Khoá']));
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.create',['attribute' => 'Khoá']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KhoaHocRequest $request, $id)
    {
        //
        try{
            $khoaHoc = KhoaHoc::find($id);
            if(!$khoaHoc){
                return back()->with('error',__('messages.not_match',['attribute' => 'Khoá']));
            }
            else{
                $tenKhoaHoc = $request->tenKhoaHoc;
                $khoaHoc->update([
                    'tenKhoa' => trim($tenKhoaHoc),
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                ]);

                return back()->with('success',__('messages.success.update'));
            }
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
            $khoaHoc = KhoaHoc::find($id);
            if(!$khoaHoc){
                return back()->with('error',__('messages.not_match',['attribute' => 'Khoá']));
            }
            else{
                $khoaHoc->delete();
                return back()->with('success',__('messages.success.delete'));
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage(). $e->getTraceAsString());
            return back()->with('error',__('messages.fails.delete'));
        }
    }
}
