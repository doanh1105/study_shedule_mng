@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Xếp lịch học - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
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
                    <h2 class="page-title">Xếp lịch học</h2>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <form action="" method="POST">
                                    <div class="d-flex">
                                        <h5 class="card-title float-left">Danh sách phân công giảng dạy - Khoa Công nghệ thông
                                            tin</h5>
                                            <a href="#" class="d-inline float-right ml-auto mb-1" onclick="requireValidate(event)">
                                                <button class="btn btn-lg btn-success mb-1 text-bold">Lưu lịch học</button></a>
                                    </div>
                                        @csrf
                                        <input type="hidden" value="{{$id_lichHoc}}" name="id_lichHoc">
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th class="h5 text-info">Môn học</th>
                                                    <th class="h5 text-info">Giảng viên</th>
                                                    <th class="h5 text-info">Phòng học</th>
                                                    <th class="h5 text-info">Ngày học</th>
                                                    <th class="h5 text-info">Tiết học</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listPhanCong as $phanCong)
                                                <tr>
                                                    <td><input onclick="noDelete()" type="text" class="form-control" readonly value="{{$phanCong->tenMonHoc}}"></td>
                                                    <td><input onclick="noDelete()" type="text" class="form-control" readonly value="{{$phanCong->ho." ".$phanCong->ten}}"></td>
                                                    <td><input onclick="noDelete()" type="text" class="form-control" readonly value="{{$phanCong->tenPhongHoc}}"></td>
                                                    <td><input onclick="noDelete()" type="text" class="form-control" readonly value="{{$phanCong->ngayDay}}"></td>
                                                    <td><input onclick="noDelete()" type="text" class="form-control" readonly value="{{collect($phanCong->tietHocs)->implode(',')}}"></td>
                                                    <td>
                                                        <a href="#"
                                                        onclick="deletePhanCong(`{{route('user.phanCong.sort_delete',[$phanCong->id])}}`)"
                                                        >
                                                        <button type="button" class="btn btn-danger">Xoá</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                <td>
                                                    <select class="form-control select2 w-50" name="id_monHoc" id="id_monHoc">
                                                        <option></option>
                                                        @foreach ($listMonHoc as $monHoc)
                                                        <option value="{{$monHoc->id}}">{{$monHoc->tenMon}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control select2 w-50" name="id_giangVien" id="id_giangVien">
                                                        <option></option>
                                                        @foreach ($listGiangVien as $giangVien)
                                                        <option value="{{$giangVien->id}}">{{$giangVien->ho." ".$giangVien->ten}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control select2 w-50" name="id_phongHoc" id="id_phongHoc">
                                                        <option></option>
                                                        @foreach ($listPhongHoc as $phongHoc)
                                                        <option value="{{$phongHoc->id}}">{{$phongHoc->tenPhongHoc}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control select2 w-50" name="id_ngayDay" id="id_ngayDay">
                                                        <option></option>
                                                        @foreach ($listNgayHoc as $ngayHoc)
                                                        <option value="{{$ngayHoc->id}}">{{$ngayHoc->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="id_tietHoc[]" multiple id="id_tietHoc">
                                                        <option></option>
                                                        @foreach ($listTietHoc as $tietHoc)
                                                        <option value="{{$tietHoc->id}}">{{$tietHoc->tenTietHoc}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
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
    @if (Session::has('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: "{{ Session::get('success') }}",
                showConfirmButton: true,
            })
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "{{ $errors->first() }}",
                showConfirmButton: true,
            })
        </script>
    @elseif (Session::has('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "{{ Session::get('error') }}",
                showConfirmButton: true,
            })
        </script>
    @endif
    <script src="{{asset('js/appCustom/delete.js')}}"></script>
    <script src="{{asset('js/appCustom/custom-lichHoc.js')}}"></script>
@endsection
