@extends('layouts.admin_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>

    {{-- Header Title --}}
    <div class="row">
        <div class="notosanLao col-md-12 text-center">
            <h3>ຈັດການຂໍ້ມູນ</h3>
        </div>
    </div>
    {{-- End Header Title --}}

    {{-- Car Category --}}

    <div class="row">
        <hr>
        <div class="col-md-12">
            <div class="card notosanLao">
                <div class="card-header bg-white">
                    <h5 class="card-title text-dark"><i class="bi bi-dash"></i> ຂໍ້ມູນຍານພາຫະນະ</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Car Brand Link --}}
                        <div class="col-md-3 mb-5">
                            <a href="{{route('AdminController.indexCarbrand')}}" class="text-decoration-none"><img src="{{ asset('assets/image/brand.png') }}" class="menu_image">
                                ຍີ່ຫໍ້ລົດ</a>
                        </div>
                        {{-- End Car Brand Link --}}

                        {{-- Insurance Company Link --}}
                        <div class="col-md-3 text-center">
                            <a href="{{route('AdminController.indexInsuranceCompany')}}" class="text-decoration-none"><img src="{{ asset('assets/image/company.png') }}" class="menu_image">
                                ບໍລິສັດປະກັນໄພ</a>
                        </div>
                        {{-- End Insurance Company Link --}}

                        {{-- Insurance Level Link --}}
                        <div class="col-md-3 text-center">
                            <a href="{{route('AdminController.indexInsuranceLevel')}}" class="text-decoration-none"><img src="{{ asset('assets/image/level.png') }}" class="menu_image">
                                ຊັ້ນປະກັນໄພ</a>
                        </div>
                        {{-- End Insurance Level Link --}}

                         {{-- Vehicle Link --}}
                         <div class="col-md-3 text-center">
                            <a href="{{route('AdminController.indexVehicleType')}}" class="text-decoration-none"><img src="{{ asset('assets/image/vehicle_type.png') }}" class="menu_image">
                                ປະເພດຍານພາຫະນະ</a>
                        </div>
                        {{-- End Vehicle Link --}}

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{route('AdminController.indexVehicleDetail')}}" class="text-decoration-none"><img src="{{ asset('assets/image/car_body.png') }}" class="menu_image">
                                ຕົວເລືອກປະເພດລົດ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Car Category --}}
@endsection

@section('styles')
    <style>
        .menu_image {
            width: auto;
            height: 70px;
        }

    </style>
@endsection
