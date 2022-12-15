@php
$user = \Illuminate\Support\Facades\Auth::user();
@endphp

<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
      <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
      <!-- nav bar -->
      <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('user.home')}}">
          <img style="width:29%" src="{{ asset('assets/images/logo.ico')}}" alt="" >
        </a>
      </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 {{request()->routeIs('user.home') ? 'active' : ''}}">
                <a class="nav-link h5" href="{{ route('user.home') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Trang chủ</span>
                </a>
            </li>

            @if($user->role != \App\Http\Utils\AppUtils::ROLE_SINH_VIEN AND $user->role != \App\Http\Utils\AppUtils::ROLE_GIANG_VIEN)
                    <li class="nav-item dropdown {{request()->routeIs('user.khoaHoc*') || request()->routeIs('user.giangVien*')
                     ? 'active' : ''}}">
                        <a href="#setting" data-toggle="collapse" aria-expanded="{{request()->routeIs('user.khoaHoc*') || request()->routeIs('user.giangVien*')
                        || request()->routeIs('user.sinhVien*') || request()->routeIs('user.phongHoc*')
                        || request()->routeIs('user.monHoc*') ? 'true' : 'false'}}" class="dropdown-toogle nav-link h5">
                            <i class="fe fe-tool fe-16"></i>
                            <span class="ml-3 item-text">Cấu hình</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100 collapse
                        {{request()->routeIs('user.khoaHoc*') || request()->routeIs('user.giangVien*')
                        || request()->routeIs('user.sinhVien*') || request()->routeIs('user.phongHoc*')
                        || request()->routeIs('user.monHoc*') ? 'show' : ''}}" id="setting">
                            @if($user->role == \App\Http\Utils\AppUtils::ROLE_ADMIN)
                                <li class="nav-item w-100">
                                    <a class="nav-link h6 {{request()->routeIs('user.khoaHoc*') ? 'text-danger' : ''}}" href="{{ route('user.khoaHoc.list') }}">
                                        <i class="fe fe-layers fe-16"></i>
                                        <span class="ml-3 item-text">Khoá đào tạo</span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item w-100">
                                <a class="nav-link h6 {{request()->routeIs('user.giangVien*') ? 'text-danger' : ''}}" href="{{ route('user.giangVien.list') }}">
                                    <i class="fe fe-user fe-16"></i>
                                    <span class="ml-3 item-text">Giảng viên</span>
                                </a>
                            </li>
                            <li class="nav-item w-100 ">
                                <a class="nav-link h6 {{request()->routeIs('user.sinhVien*') ? 'text-danger' : ''}}" href="{{ route('user.sinhVien.list') }}">
                                    <i class="fe fe-users fe-16"></i>
                                    <span class="ml-3 item-text">Sinh viên</span>
                                </a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link h6 {{request()->routeIs('user.phongHoc*') ? 'text-danger' : ''}}" href="{{ route('user.phongHoc.list') }}">
                                    <i class="fe fe-codepen fe-16"></i>
                                    <span class="ml-3 item-text">Phòng học</span>
                                </a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link h6 {{request()->routeIs('user.monHoc*') ? 'text-danger' : ''}}" href="{{ route('user.monHoc.list') }}">
                                    <i class="fe fe-book-open fe-16"></i>
                                    <span class="ml-3 item-text">Môn học</span>
                                </a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link h6" href="{{ route('user.home') }}">
                                    <i class="fe fe-voicemail fe-16"></i>
                                    <span class="ml-3 item-text">Tiết học</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#fileman" data-toggle="collapse" aria-expanded="false" class="nav-link h5">
                            <i class="fe fe-aperture fe-16"></i>
                            <span class="ml-3 item-text">Quản lý lịch</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="fileman">
                            <li class="nav-item w-100">
                                <a class="nav-link h6" href="{{ route('user.home') }}">
                                    <i class="fe fe-users fe-16"></i>
                                    <span class="ml-3 item-text">Quản lý lịch học</span>
                                </a>
                            </li>
                            <li class="nav-item w-100">
                                <a class="nav-link h6" href="{{ route('user.home') }}">
                                    <i class="fe fe-codepen fe-16"></i>
                                    <span class="ml-3 item-text">Quản lý lịch thi</span>
                                </a>
                            </li>
                        </ul>
                    </li>
            @endif

                <li class="nav-item dropdown">
                    <a href="#xem_lich" data-toggle="collapse" aria-expanded="false" class="nav-link h5">
                        <i class="fe fe-eye fe-16"></i>
                        <span class="ml-3 item-text">Xem lịch</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="xem_lich">
                        <li class="nav-item w-100">
                            <a class="nav-link h6" href="{{ route('user.home') }}">
                                <i class="fe fe-users fe-16"></i>
                                <span class="ml-3 item-text">Xem lịch học</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link h6" href="{{ route('user.home') }}">
                                <i class="fe fe-codepen fe-16"></i>
                                <span class="ml-3 item-text">Xem lịch thi</span>
                            </a>
                        </li>
                    </ul>
                </li>
        </ul>
    </nav>
  </aside>
