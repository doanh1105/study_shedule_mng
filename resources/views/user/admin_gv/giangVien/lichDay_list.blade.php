@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Xem lịch giảng dạy - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')
<style>
 .select2-container--bootstrap4 {
    width: auto !important;
    flex: 1 1 auto !important;
}

.select2-container--bootstrap4 .select2-selection--single {
    height: 100% !important;
    line-height: inherit !important;
}
.select2-results__option[aria-selected=true] {
    display: none;
}
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
                    <h2 class="page-title">Xem lịch giảng dạy</h2>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                            <div>
                                                <h3 class="card-title">Lịch giảng dạy</h3>
                                                <p class="h5">Giảng viên: <span class="text-info">{{$userDay->ho." ".$userDay->ten}}</span></p>
                                            </div>
                                    </div>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th class="h5 text-info">Môn</th>
                                                    <th class="h5 text-info">Phòng học</th>
                                                    <th class="h5 text-info">Ngày dạy</th>
                                                    <th class="h5 text-info">Tiết</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listPhanCong as $phanCong)
                                                <tr>
                                                    <td><input type="text" class="form-control" readonly value="{{$phanCong->tenMonHoc}}"></td>
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

{{-- add js --}}
@section('js')
@endsection
