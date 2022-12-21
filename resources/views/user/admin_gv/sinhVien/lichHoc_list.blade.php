@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Xem lịch học - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')
@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">Lịch học</h2>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div>
                                        <h5 class="card-title">Danh sách Lịch học - Khoa Công nghệ thông
                                            tin</h5>
                                        <p class="h5">Khoá: {{$khoaHoc->tenKhoa}}</p>
                                        <p class="h5">Ngành đào tạo: {{$nganhHoc->tenNganhHoc}}</p>
                                    </div>
                                    <table class="table table-hover">
                                        <thead class="text-primary">
                                            <tr class="thead-dark">
                                                <th>Tên lịch học</th>
                                                <th>Thời gian bắt đầu</th>
                                                <th>Thời gian kết thúc</th>
                                                <th>Khoá đào tạo</th>
                                                <th>Ngành học</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listLichHoc as $lichHoc)
                                                <tr>
                                                    <td>{{ $lichHoc->tenLichHoc }}</td>
                                                    <td>{{\Illuminate\Support\Carbon::parse($lichHoc->ngayBatDau)->format('d-m-Y') }}</td>
                                                    <td>{{\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->format('d-m-Y') }}</td>
                                                    <td>{{ $lichHoc->tenKhoa }}</td>
                                                    <td>{{ $lichHoc->tenNganhHoc }}</td>
                                                    @if (\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->lt(now()) )
                                                    <td><span class="badge badge-pill badge-secondary">Đã kết thúc</span></td>
                                                    @else
                                                    <td><span class="badge badge-pill badge-success">Đang áp dụng</span></td>
                                                    @endif
                                                    <td>
                                                        <a href="{{route('user.lichHoc.view',[$lichHoc->id, $lichHoc->id_nganhHoc, $lichHoc->id_khoaHoc])}}" target="_blank">
                                                            <button class="btn btn-primary mr-1 mb-1"
                                                                >Xem</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">{{ $listLichHoc->links() }}</div>
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
