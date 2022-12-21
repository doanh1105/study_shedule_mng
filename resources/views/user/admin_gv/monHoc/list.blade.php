@extends('user.layouts.layout')

{{-- title --}}
@section('title')
    <title>Quản lí Môn học - Hệ thống Quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')
@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">Môn học</h2>
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h5 class="card-title float-left">Danh sách môn học - Khoa Công nghệ thông
                                            tin</h5>
                                        <button class="btn btn-success ml-auto mb-1" data-toggle="modal"
                                            data-target="#add-mon">Thêm môn học</button>
                                    </div>
                                    <div class="f-flex justify-content-center">
                                        <table class="table table-hover" style="margin: auto">
                                            <thead class="text-primary">
                                                <tr class="thead-dark">
                                                    <th>Mã môn học</th>
                                                    <th>Tên môn học</th>
                                                    <th>Khoá</th>
                                                    <th>Khối ngành đào tạo</th>
                                                    <th>Thời gian bắt đầu</th>
                                                    <th>Thời gian kết thúc</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listMonHoc as $monHoc)
                                                    <tr>
                                                        <td>{{ $monHoc->maMon }}</td>
                                                        <td>{{ $monHoc->tenMon }}</td>
                                                        <td>{{ $monHoc->khoa }}</td>
                                                        <td>{{ $monHoc->tenNganhHoc }}</td>
                                                        <td>{{ \Illuminate\Support\Carbon::parse($monHoc->start_time)->format('d-m-Y') }}</td>
                                                        <td>{{ \Illuminate\Support\Carbon::parse($monHoc->end_time)->format('d-m-Y') }} </td>
                                                        <td>
                                                            <button class="btn btn-warning mr-1 mb-1" data-toggle="modal"
                                                                data-target="#sua-mon-hoc-{{ $monHoc->id }}">Sửa</button>
                                                            <a href="#"
                                                                onclick="deleteMonHoc(`{{ route('user.monHoc.delete', ['id' => $monHoc->id]) }}`)"><button
                                                                    class="btn btn-danger mb-1">Xoá</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">{{ $listMonHoc->links() }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="add-mon" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm môn học</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.monHoc.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input class="form-control form-control-lg mb-3" name="maMonHoc" maxlength="30" type="text"
                                placeholder="Mã môn học" required>
                            <input class="form-control form-control-lg mb-3" name="tenMonHoc" type="text"
                                placeholder="Tên môn học" required>
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
                            <button type="submit" class="btn btn-primary"  onclick="validateDate(event,'time_start','time_end')">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($listMonHoc as $monHoc)
            <div class="modal fade" id="sua-mon-hoc-{{ $monHoc->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Sửa thông tin môn học</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('user.monHoc.update', ['id' => $monHoc->id]) }}" method="POST">
                            @csrf
                            <div class="modal-body form-group">
                                <label for="time_start">Mã môn học</label>
                                <input class="form-control form-control-lg mb-3" name="maMonHoc" value="{{$monHoc->maMon}}" maxlength="30" type="text"
                                placeholder="Mã môn học" required>
                                <label for="time_start">Tên môn học</label>
                                <input class="form-control form-control-lg mb-3" value="{{ $monHoc->tenMon }}"
                                    name="tenMonHoc" maxlength="30" type="text" placeholder="Tên môn học" required>
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
    <script src="{{ asset('js/appCustom/custom.js')}}"></script>
@endsection
