@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="fw-bold">Website Main Page Setting</h3>
        </div>
    </div>
      {{-- Navigation --}}
      <nav aria-label="breadcrumb ">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showNewAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Website setting</li>
        </ol>
    </nav>
    <hr>
    <div class="pt-5"></div>
    <div class="container">
        <div class="row">
            <div class="col text-center border p-2 rounded shadow">
                <a href="{{route('WebsiteController.ImageSlide')}}" class="text-decoration-none text-dark">
                    <img src="{{ asset('assets/image/slide_image.png') }}" class="border icon-menu mb-3">
                    <p class="fw-bold fs-4">Image Slide Show</p>
                </a>
            </div>
            <div class="col">
                <div class="col text-center border p-2 rounded shadow">
                    <a href="#" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/image/insurance_type.png') }}" class="border icon-menu mb-3">
                        <p class="fw-bold fs-4">ຮູບແບບປະກັນໄພ</p>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="col text-center border p-2 rounded shadow">
                    <a href="#" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/image/howtopay.png') }}" class="border icon-menu mb-3">
                        <p class="fw-bold fs-4">ວິທີຈ່າຍເງິນ</p>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="col text-center border p-2 rounded shadow">
                    <a href="#" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/image/partner.png') }}" class="border icon-menu mb-3">
                        <p class="fw-bold fs-4">ຄູ່ຮ່ວມປະກັັນໄພ</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="pt-4"></div>
        <div class="row">
            <div class="col text-center border p-2 rounded shadow">
                <a href="#" class="text-decoration-none text-dark">
                    <img src="{{ asset('assets/image/comment.png') }}" class="border icon-menu mb-3">
                    <p class="fw-bold fs-4">ຄຳຄິດເຫັນຂອງລູກຄ້າ</p>
                </a>
            </div>
            <div class="col">
                <div class="col text-center border p-2 rounded shadow">
                    <a href="#" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/image/contact_us.png') }}" class="border icon-menu mb-3">
                        <p class="fw-bold fs-4">ຕິດຕໍ່ພວກເຮົາ</p>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="col text-center border p-2 rounded shadow">
                    <a href="#" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/image/company_info.png') }}" class="border icon-menu mb-3">
                        <p class="fw-bold fs-4">ຂໍ້ມູນບໍລິສັດ</p>
                    </a>
                </div>
            </div>
            <div class="col">
                {{-- <div class="col text-center border p-2 rounded shadow">
                    <a href="#" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/image/partner.png') }}" class="border icon-menu mb-3">
                        <p class="fw-bold fs-4">ຄູ່ຮ່ວມປະກັັນໄພ</p>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .icon-menu {
            width: 100px;
            height: 100px;
        }

    </style>
@endsection
