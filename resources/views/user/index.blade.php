@extends('user.layouts.layout')

{{-- title --}}
@section('title')
<title>Trang chủ - Hệ thống quản lí lịch học - Khoa Công nghệ thông tin</title>
@endsection

{{-- add css --}}
@section('css')

@endsection

@php
$user = Auth::user();
@endphp

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="row align-items-center mb-2">
            <div class="col">
              <h2 class="h5 page-title">Xin chào {{$user->ho." ".$user->ten}}!</h2>
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
