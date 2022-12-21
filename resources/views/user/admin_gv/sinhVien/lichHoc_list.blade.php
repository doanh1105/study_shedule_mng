@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Quản lí Lich học - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
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
                                    <div class="d-flex">
                                        <h5 class="card-title float-left">Danh sách Lịch học - Khoa Công nghệ thông
                                            tin</h5>
                                        <button class="btn btn-success ml-auto mb-1" data-toggle="modal"
                                            data-target="#add-khoa">Thêm Lịch học</button>
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
                                                        <a href="{{route('user.lichHoc.sort_view',['id_lichHoc' => $lichHoc->id,'id_nganhHoc' => $lichHoc->id_nganhHoc, 'id_khoaHoc' => $lichHoc->id_khoaHoc])}}" target="_blank">
                                                            <button class="btn {{\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->lt(now()) ? 'btn-secondary' : 'btn-success'}}  mr-1 mb-1" {{\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->lt(now()) ? 'disabled' : ''}}
                                                                >Xếp lịch học</button>
                                                        </a>
                                                        <button class="btn {{\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->lt(now()) ? 'btn-secondary' : 'btn-warning'}}  mr-1 mb-1" {{\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->lt(now()) ? 'disabled' : ''}} data-toggle="modal"
                                                            data-target="#sua-lich-hoc-{{ $lichHoc->id }}">Sửa thông tin</button>
                                                        <a href="#"
                                                            onclick="deleteLichHoc(`{{ route('user.lichHoc.delete', ['id' => $lichHoc->id]) }}`)"><button {{\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->lt(now()) ? 'disabled' : ''}}
                                                                class="btn {{\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->lt(now()) ? 'btn-secondary' : 'btn-danger'}}  mb-1">Xoá</button></a>
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

        {{-- thêm lịch học mới --}}
        <div class="modal fade" id="add-khoa" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm lịch học</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.lichHoc.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input class="form-control form-control-lg mb-3" name="tenLichHoc" type="text"
                                placeholder="Tên lịch học" required>
                             <select class="form-control form-control-lg mb-3" name="id_khoaHoc">
                                @foreach ($listKhoaHoc as $khoaHoc)
                                    <option value="{{ $khoaHoc->id }}">{{ $khoaHoc->tenKhoa }}</option>
                                @endforeach
                            </select>
                            <select class="form-control form-control-lg mb-3" name="id_nganhHoc">
                                @foreach ($listNganhHoc as $nganhHoc)
                                    <option value="{{ $nganhHoc->id }}">{{ $nganhHoc->tenNganhHoc }}</option>
                                @endforeach
                            </select>
                            <label for="time_start">Thời gian bắt đầu</label>
                            <input class="form-control form-control-lg mb-4" type="date" name="start_time" id="time_start" required
                                placeholder="Thời gian bắt đầu" required>
                            <label for="end_start">Thời gian kết thúc</label>
                            <input class="form-control form-control-lg" type="date" name="end_time" id="time_end" required
                                placeholder="Thời gian kết thúc" required>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary" onclick="validateDate(event,'time_start','time_end')">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- sửa lịch học --}}
        @foreach ($listLichHoc as $lichHoc)
            <div class="modal fade" id="sua-lich-hoc-{{ $lichHoc->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa lịch học</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('user.lichHoc.update', ['id' => $lichHoc->id]) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                            <div class="bg-warning text-white mb-3">
                                <span>Lưu ý: Thao tác này không thể chỉnh sửa khoá học và ngành học.
                                    Nếu muốn thay đổi các thông tin này, vui lòng xoá lịch học và tạo lại lịch học khác</span></div>
                            <label for="time_start">Tên lịch học</label>
                            <input class="form-control form-control-lg mb-3" value="{{ $lichHoc->tenLichHoc}}" name="tenLichHoc" type="text"
                                placeholder="Tên lịch học" required>
                            <label for="start_time-{{$lichHoc->id}}">Thời gian bắt đầu</label>
                            <input class="form-control form-control-lg" type="date" value="{{\Illuminate\Support\Carbon::parse($lichHoc->ngayBatDau)->format('Y-m-d')}}" name="start_time" id="start_time-{{$lichHoc->id}}" required
                                placeholder="Thời gian bắt đầu" required>
                            <label for="end_time-{{$lichHoc->id}}">Thời gian kết thúc</label>
                            <input class="form-control form-control-lg" type="date" value="{{\Illuminate\Support\Carbon::parse($lichHoc->ngayKetThuc)->format('Y-m-d')}}" name="end_time" id="end_time-{{$lichHoc->id}}" required
                                placeholder="Thời gian kết thúc" required>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary" onclick="validateDate(event,'start_time-{{$lichHoc->id}}','end_time-{{$lichHoc->id}}')">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
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
    <script src="{{ asset('js/appCustom/delete.js') }}"></script>
    <script src="{{ asset('js/appCustom/custom.js') }}"></script>
@endsection
