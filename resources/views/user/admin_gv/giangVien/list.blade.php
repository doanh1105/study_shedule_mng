@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Quản lí Giảng viên - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')
@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">Giảng viên</h2>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title float-left">Danh sách giảng viên - Khoa Công nghệ thông
                                            tin</h5>
                                        <button class="btn btn-success ml-auto mb-1" data-toggle="modal"
                                            data-target="#add-gv">Thêm giảng viên</button>
                                    </div>
                                    <div class="f-flex justify-content-center">
                                        <table class="table table-hover w-50" style="margin: auto">
                                            <thead class="text-primary">
                                                <tr class="thead-dark">
                                                    <th>Tên giảng viên</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listUsers as $user)
                                                <tr>
                                                    <td>{{ $user->ho." ".$user->ten }}</td>
                                                    <td>
                                                        <button class="btn btn-warning mr-1 mb-1" data-toggle="modal"
                                                            data-target="#sua-giang-vien-{{$user->id}}">Sửa</button>
                                                        <a href="#" onclick="deleteGiangVien(`{{route('user.giangVien.delete',['id' => $user->id])}}`)"><button class="btn btn-danger mb-1">Xoá</button></a>
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


        <div class="modal fade" id="add-gv" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm giảng viên mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.giangVien.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input class="form-control form-control-lg mb-3" name="first_name" maxlength="30" type="text"
                                placeholder="Họ và tên đệm" required>
                            <input class="form-control form-control-lg mb-3" name="last_name" maxlength="30" type="text"
                                placeholder="Tên" required>
                            <input class="form-control form-control-lg mb-3" name="username" minlength="6" maxlength="20" type="text"
                                placeholder="Mã giảng viên" required>
                            <input class="form-control form-control-lg mb-3" name="password" minlength="6" maxlength="20" type="password"
                                placeholder="Mật khẩu đăng nhập" required>
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
            <div class="modal fade" id="sua-giang-vien-{{$user->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa thông tin giảng viên</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('user.giangVien.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                            <input class="form-control form-control-lg mb-3" value="{{$user->ho}}" name="first_name" maxlength="30" type="text"
                                placeholder="Họ và tên đệm" required>
                            <input class="form-control form-control-lg mb-3" value="{{$user->ten}}" name="last_name" maxlength="30" type="text"
                                placeholder="Tên" required>
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
    <script src="{{asset('js/appCustom/delete.js')}}"></script>
@endsection
