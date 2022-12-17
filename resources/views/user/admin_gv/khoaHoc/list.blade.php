@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Quản lí Khoá đào tạo - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')
@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">Khoá đào tạo</h2>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title float-left">Danh sách các Khoá đào tạo - Khoa Công nghệ thông
                                            tin</h5>
                                        <button class="btn btn-success ml-auto mb-1" data-toggle="modal"
                                            data-target="#add-khoa">Thêm Khoá</button>
                                    </div>
                                    <table class="table table-hover">
                                        <thead class="text-primary">
                                            <tr class="thead-dark">
                                                <th>Tên khoá đào tạo</th>
                                                <th>Năm bắt đầu</th>
                                                <th>Năm kết thúc</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list_khoaHoc as $khoaHoc)
                                                <tr>
                                                    <td>{{ $khoaHoc->tenKhoa }}</td>
                                                    <td>{{ $khoaHoc->start_time }}</td>
                                                    <td>{{ $khoaHoc->end_time }}</td>
                                                    <td>
                                                        <button class="btn btn-warning mr-1 mb-1" data-toggle="modal"
                                                            data-target="#sua-khoa-hoc-{{ $khoaHoc->id }}">Sửa</button>
                                                        <a href="#"
                                                            onclick="deleteKhoa(`{{ route('user.khoaHoc.destroy', ['id' => $khoaHoc->id]) }}`)"><button
                                                                class="btn btn-danger mb-1">Xoá</button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">{{ $list_khoaHoc->links() }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- thêm khoá mới --}}
        <div class="modal fade" id="add-khoa" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm khoá đào tạo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.khoaHoc.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input class="form-control form-control-lg" name="tenKhoaHoc" type="text"
                                placeholder="Tên khoá đào tạo" required>
                            <input class="form-control form-control-lg mt-3" id="time_start" name="start_time" value="2015" type="number" min="2015" max="2099"
                                placeholder="Năm bắt đầu" required>
                            <input class="form-control form-control-lg mt-3" id="time_end" name="end_time" value="2019" type="number" min="2015" max="2099"
                                placeholder="Năm kết thúc" required>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary" onclick="validateTime(event,'time_start','time_end')">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- sửa khoá học --}}
        @foreach ($list_khoaHoc as $khoaHoc)
            <div class="modal fade" id="sua-khoa-hoc-{{ $khoaHoc->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa khoá đào tạo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('user.khoaHoc.update', ['id' => $khoaHoc->id]) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input class="form-control form-control-lg" value="{{ $khoaHoc->tenKhoa }}"
                                    name="tenKhoaHoc" type="text" placeholder="Tên khoá đào tạo" required>
                                <input class="form-control form-control-lg mt-3" id="start_time-{{$khoaHoc->id}}" name="start_time" value="{{ $khoaHoc->start_time }}" type="number" min="2015" max="2099"
                                    placeholder="Năm bắt đầu" required>
                                <input class="form-control form-control-lg mt-3" id="end_time-{{$khoaHoc->id}}" name="end_time" value="{{ $khoaHoc->end_time }}" type="number" min="2015" max="2099"
                                    placeholder="Năm kết thúc" required>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary" onclick="validateTime(event,'start_time-{{$khoaHoc->id}}','end_time-{{$khoaHoc->id}}')">Lưu</button>
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
