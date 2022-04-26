@extends('layouts.admin_layout')
@section('content')
<div class="pt-5"></div>
<div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center fw-bold">Image Slide</h3>
        </div>
    </div>
    {{-- Navigation --}}
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showNewAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('WebsiteController.index') }}">Website Setting</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຮຸບແບບປະກັນໄພ</li>
        </ol>
    </nav>
    <hr>
    
@endsection