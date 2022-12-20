<?php

namespace App\Http\Middleware;

use App\Models\LichHoc;
use Closure;
use Illuminate\Support\Facades\Log;

class CheckLichHocCanSort
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id_lichHoc = $request->route('id_lichHoc');
        $lichHoc = LichHoc::find($id_lichHoc);
        if(!$lichHoc){
            abort(404);
        };
        if($lichHoc && $lichHoc->ngayKetThuc <= now()){
            return redirect()->route('user.home');
        }
        return $next($request);
    }
}
