@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Xếp lịch học - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')
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
                                    <div class="d-flex">
                                        <h5 class="card-title float-left">Danh sách Lịch học - Khoa Công nghệ thông
                                            tin</h5>
                                    </div>
                                    <form action="" method="POST">
                                        <input type="hidden" value="" name="id_lichHoc">
                                        <table class="table table-bordered">
                                            <thead class="text-primary">
                                                <tr class="thead-light">
                                                    <th>Môn học</th>
                                                    <th>Giảng viên</th>
                                                    <th>Phòng học</th>
                                                    <th>Ngày học</th>
                                                    <th>Tiết học</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listMonHoc as $monHoc)
                                                <tr>
                                                <td>{{$monHoc->tenMon}}</td>
                                                <td>
                                                    <select class="form-control w-50" name="id_giangVien">
                                                        @foreach ($listGiangVien as $giangVien)
                                                        <option value="{{$giangVien->id}}">{{$giangVien->ho." ".$giangVien->ten}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control w-50" name="id_phongHoc">
                                                        @foreach ($listPhongHoc as $phongHoc)
                                                        <option value="{{$phongHoc->id}}">{{$phongHoc->tenPhongHoc}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control w-50" name="id_ngayDay">
                                                        @foreach ($listNgayHoc as $ngayHoc)
                                                        <option value="{{$ngayHoc->id}}">{{$ngayHoc->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control w-50" name="id_ngayDay">
                                                        @foreach ($listTietHoc as $tietHoc)
                                                        <option value="{{$tietHoc->id}}">{{$tietHoc->tenTietHoc}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                </tr>
                                                @endforeach
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
    <script src="{{ asset('js/appCustom/custom.js') }}"></script>
@endsection
