@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Quản lí Sinh viên - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')
@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">Sinh viên</h2>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title float-left">Danh sách sinh viên - Khoa Công nghệ thông
                                            tin</h5>
                                        <button class="btn btn-success ml-auto mb-1" data-toggle="modal"
                                            data-target="#add-sv">Thêm sinh viên</button>
                                    </div>
                                    <div class="f-flex justify-content-center">
                                        <table class="table table-hover" style="margin: auto">
                                            <thead class="text-primary">
                                                <tr class="thead-dark">
                                                    <th>Tên sinh viên</th>
                                                    <th>Mã sinh viên</th>
                                                    <th>Khoá</th>
                                                    <th>Khối ngành đào tạo</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listUsers as $user)
                                                    <tr>
                                                        <td>{{ $user->ho . ' ' . $user->ten }}</td>
                                                        <td>{{ $user->maNguoiDung }}</td>
                                                        <td>{{ $user->khoa }}</td>
                                                        <td>{{ $user->tenNganhHoc }}</td>
                                                        <td>
                                                            <button class="btn btn-warning mr-1 mb-1" data-toggle="modal"
                                                                data-target="#sua-sinh-vien-{{ $user->id }}">Sửa</button>
                                                            <a href="#"
                                                                onclick="deleteSinhVien(`{{ route('user.sinhVien.delete', ['id' => $user->id]) }}`)"><button
                                                                    class="btn btn-danger mb-1">Xoá</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">{{ $listUsers->links() }}</div>
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
                        <h5 class="modal-title">Thêm sinh viên</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.sinhVien.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input class="form-control form-control-lg mb-3" name="first_name" maxlength="30" type="text"
                                placeholder="Họ và tên đệm" required>
                            <input class="form-control form-control-lg mb-3" name="last_name" maxlength="30" type="text"
                                placeholder="Tên" required>
                            <select class="form-control form-control-lg mb-3" name="id_Khoa">
                                @foreach ($listKhoaHoc as $khoaHoc)
                                    <option value="{{ $khoaHoc->id }}">{{ $khoaHoc->tenKhoa }}</option>
                                @endforeach
                            </select>
                            <select class="form-control form-control-lg mb-3" name="maNganhDaoTao">
                                @foreach ($listNganhHoc as $nganhHoc)
                                    <option value="{{ $nganhHoc->id }}">{{ $nganhHoc->tenNganhHoc }}</option>
                                @endforeach
                            </select>
                            <input class="form-control form-control-lg mb-3" name="username" minlength="6" maxlength="20"
                                type="text" placeholder="Mã sinh viên" required>
                            <input class="form-control form-control-lg mb-3" name="password" minlength="6" maxlength="20"
                                type="password" placeholder="Mật khẩu đăng nhập" required>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($listUsers as $user)
            <div class="modal fade" id="sua-sinh-vien-{{ $user->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa thông tin sinh viên</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('user.sinhVien.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input class="form-control form-control-lg mb-3 bg-info" value="{{ $user->maNguoiDung }}"
                                    readonly disabled>
                                <input class="form-control form-control-lg mb-3" value="{{ $user->ho }}"
                                    name="first_name" maxlength="30" type="text" placeholder="Họ và tên đệm" required>
                                <input class="form-control form-control-lg mb-3" value="{{ $user->ten }}"
                                    name="last_name" maxlength="30" type="text" placeholder="Tên" required>
                                    <select class="form-control form-control-lg mb-3" name="id_Khoa">
                                        @foreach ($listKhoaHoc as $khoaHoc)
                                            <option value="{{ $khoaHoc->id }}">{{ $khoaHoc->tenKhoa }}</option>
                                        @endforeach
                                    </select>
                                <select class="form-control form-control-lg mb-3" name="maNganhDaoTao">
                                    @foreach ($listNganhHoc as $nganhHoc)
                                        <option value="{{ $nganhHoc->id }}"
                                            {{ $user->id_nganhHoc == $nganhHoc->id ? 'selected' : '' }}>
                                            {{ $nganhHoc->tenNganhHoc }}</option>
                                    @endforeach
                                </select>
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
