@extends('layouts.admin_layout')
@section('content')
<div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>ຈັດການຂໍ້ມູນລາຍການທີ່ຄຸ້ມຄອງ</h3>
        </div>
    </div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຈັດການຂໍ້ມູນລາຍການທີ່ຄຸ້ມຄອງ</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}

    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{asset($headerTitleData->logo)}}" alt="{{$headerTitleData->company_name}}" class="company_logo rounded">
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .company_logo{
            width: auto;
            height: 100px;
        }
    </style>
@endsection