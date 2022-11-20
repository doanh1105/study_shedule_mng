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
                                                <th>Số lượng sinh viên</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>K68</td>
                                                <td>1</td>
                                                <td>
                                                    <button class="btn btn-warning mr-1 mb-1">Sửa</button>
                                                    <button class="btn btn-danger mb-1">Xoá</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>K69</td>
                                                <td>1</td>
                                                <td>
                                                    <button class="btn btn-warning mr-1 mb-1">Sửa</button>
                                                    <button class="btn btn-danger mb-1">Xoá</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center"><button
                                            class="btn btn-outline-primary">links</button></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- thêm khoá mới --}}
        <div class="modal fade" id="add-khoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm khoá đào tạo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.khoaHoc.store')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input class="form-control form-control-lg" name="tenKhoaHoc" type="text" placeholder="Tên khoá đào tạo"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
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

    @if (Session::has('error'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: "{{ Session::get('error') }}",
            showConfirmButton: true,
        })
    </script>
    @endif
@endsection
