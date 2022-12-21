@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Xem lịch học - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')
<style>
     .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
     border: 1px solid rgb(194, 189, 189);
 }
</style>
@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">Xem lịch học</h2>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div>
                                            <h3 class="card-title float-left">Danh sách phân công giảng dạy - Khoa Công nghệ thông
                                                tin</h3>
                                                <p class="h5">{{$lichHoc->tenLichHoc}}</p>
                                                <p class="h5">Khoá: {{$khoaHoc->tenKhoa}}</p>
                                                <p class="h5">Ngành đào tạo: {{$nganhHoc->tenNganhHoc}}</p>
                                                <p class="h5">Thời gian: {{\Illuminate\Support\Carbon::parse($lichHoc->ngayBatDau)->format('d-m-Y')}} đến {{\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->format('d-m-Y')}}</p>


                                        </div>
                                    </div>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th class="h5 text-info">Môn học</th>
                                                    <th class="h5 text-info">Giảng viên</th>
                                                    <th class="h5 text-info">Phòng học</th>
                                                    <th class="h5 text-info">Ngày học</th>
                                                    <th class="h5 text-info">Tiết học</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listPhanCong as $phanCong)
                                                <tr>
                                                    <td><input type="text" class="form-control" readonly value="{{$phanCong->tenMonHoc}}"></td>
                                                    <td><input type="text" class="form-control" readonly value="{{$phanCong->ho." ".$phanCong->ten}}"></td>
                                                    <td><input type="text" class="form-control" readonly value="{{$phanCong->tenPhongHoc}}"></td>
                                                    <td><input type="text" class="form-control" readonly value="{{$phanCong->ngayDay}}"></td>
                                                    <td><input type="text" class="form-control" readonly value="{{collect($phanCong->tietHocs)->implode(',')}}"></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

