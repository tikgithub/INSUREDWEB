@extends('layouts.admin_layout')
@section('content')
<div class="pt-5"></div>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-center fw-bold">Website Information</h3>
    </div>
</div>
{{-- Navigation --}}
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb notosanLao">
        <li class="breadcrumb-item"><a href="{{ route('AdminController.showNewAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
        <li class="breadcrumb-item"> <a href="{{ route('WebsiteController.index') }}">Website Setting</a></li>
        <li class="breadcrumb-item active" aria-current="page">Website Information</li>
    </ol>
</nav>
<hr>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <form action="" method="post" class="fs-4" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label class="col-sm-3">ຊື່ Website</label>
                <div class="col-sm-9">
                    <input type="text" name="website_name" id="website_name" class="form-control">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('styles')
    
@endsection

@section('scripting')
    @include('toastrMessage')
@endsection