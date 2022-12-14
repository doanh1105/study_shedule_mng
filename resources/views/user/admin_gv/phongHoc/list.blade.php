@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Quản lí Phòng học - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')
@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">Phòng học</h2>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title float-left">Danh sách phòng học - Khoa Công nghệ thông
                                            tin</h5>
                                        <button class="btn btn-success ml-auto mb-1" data-toggle="modal"
                                            data-target="#add-sv">Thêm phòng học</button>
                                    </div>
                                    <div class="f-flex justify-content-center">
                                        <table class="table table-hover w-50" style="margin: auto">
                                            <thead class="text-primary">
                                                <tr class="thead-dark">
                                                    <th>Mã phòng học</th>
                                                    <th>Tên phòng học</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listPhongHoc as $phongHoc)
                                                    <tr>
                                                        <td>{{ $phongHoc->maPhongHoc }}</td>
                                                        <td>{{ $phongHoc->tenPhongHoc }}</td>
                                                        <td>
                                                            <button class="btn btn-warning mr-1 mb-1" data-toggle="modal"
                                                                data-target="#sua-phong-hoc-{{ $phongHoc->id }}">Sửa</button>
                                                            <a href="#"
                                                                onclick="deletePhongHoc(`{{ route('user.phongHoc.delete', ['id' => $phongHoc->id]) }}`)"><button
                                                                    class="btn btn-danger mb-1">Xoá</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">{{ $listPhongHoc->links() }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="add-sv" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm phòng học</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.phongHoc.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input class="form-control form-control-lg mb-3" name="maPhongHoc" maxlength="30" type="text"
                                placeholder="Mã phòng học" required>
                            <input class="form-control form-control-lg mb-3" name="tenPhongHoc" maxlength="30" type="text"
                                placeholder="Tên phòng học" required>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($listPhongHoc as $phongHoc)
            <div class="modal fade" id="sua-phong-hoc-{{ $phongHoc->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa thông tin phòng học</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('user.phongHoc.update', ['id' => $phongHoc->id]) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input class="form-control form-control-lg mb-3 bg-info" value="{{ $phongHoc->maPhongHoc }}"
                                    readonly disabled>
                                <input class="form-control form-control-lg mb-3" value="{{ $phongHoc->tenPhongHoc }}"
                                    name="tenPhongHoc" maxlength="30" type="text" placeholder="Tên Phòng học" required>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Lưu</button>
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
@endsection
