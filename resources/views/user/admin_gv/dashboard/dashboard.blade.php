@extends('user.layouts.layout')

{{-- title --}}
@section('title')
<title>Trang chủ - Hệ thống quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')

@endsection

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="row align-items-center mb-2">
            <div class="col-12 mb-5">
              <h2 class="h5 page-title">Thống kê</h2>
            </div>
              <div class="col-12">
                  <div class="row">
                      <div class="col-md-6 mb-4">
                          <div class="card shadow bg-primary-darker text-white border-0">
                              <div class="card-body">
                                  <div class="row align-items-center">
                                      <div class="col-3 text-center">
                       <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-layers text-white mb-0"></i>
                          </span>
                                      </div>
                                      <div class="col pr-0">
                                          <p class="small text-white mb-0">Khoá đào tạo</p>
                                          <span class="h3 mb-0 text-white">{{$count_khoaHoc}}</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 mb-4">
                          <div class="card shadow bg-success text-black-50 border-0">
                              <div class="card-body">
                                  <div class="row align-items-center">
                                      <div class="col-3 text-center">
                          <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-user text-white mb-0"></i>
                          </span>
                                      </div>
                                      <div class="col pr-0">
                                          <p class="small text-white mb-0">Giảng viên</p>
                                          <span class="h3 text-white mb-0">{{$count_giangVien}}</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 mb-4">
                          <div class="card shadow bg-danger-light border-0">
                              <div class="card-body">
                                  <div class="row align-items-center">
                                      <div class="col-3 text-center">
                          <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-users text-white mb-0"></i>
                          </span>
                                      </div>
                                      <div class="col pr-0">
                                          <p class="small text-white mb-0">Sinh viên</p>
                                          <span class="h3 text-white mb-0">{{$count_sinhVien}}</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 mb-4">
                          <div class="card shadow bg-info border-0">
                              <div class="card-body">
                                  <div class="row align-items-center">
                                      <div class="col-3 text-center">
                          <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-codepen text-white mb-0"></i>
                          </span>
                                      </div>
                                      <div class="col pr-0">
                                          <p class="small text-white mb-0">Phòng học</p>
                                          <span class="h3 text-white mb-0">{{$count_phongHoc}}</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 mb-4">
                          <div class="card shadow bg-dark-lighter border-0">
                              <div class="card-body">
                                  <div class="row align-items-center">
                                      <div class="col-3 text-center">
                          <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-book-open text-white mb-0"></i>
                          </span>
                                      </div>
                                      <div class="col pr-0">
                                          <p class="small text-white mb-0">Môn học</p>
                                          <span class="h3 text-white mb-0">{{$count_monHoc}}</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
        </div> <!-- .col-12 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->
  </main>
@endsection

{{-- add js --}}
@section('js')

@endsection
