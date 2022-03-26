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

    {{-- Basic Information Categories --}}
    <div class="row p-3">
        <hr>
        <div class="col-md-12">
            <div class="card notosanLao shadow">
                <div class="card-header bg-white">
                    <h5 class="card-title text-dark"><i class="bi bi-dash"></i> ຂໍ້ມູນພື້ນຖານ</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Car Brand Link --}}
                        <div class="col-md-3 mb-5">
                            <a href="{{ route('AdminController.indexCarbrand') }}"
                                class="text-decoration-none text-dark"><img src="{{ asset('assets/image/brand.png') }}"
                                    class="menu_image">
                                ຍີ່ຫໍ້ລົດ</a>
                        </div>
                        {{-- End Car Brand Link --}}

                        {{-- Insurance Company Link --}}
                        <div class="col-md-3 text-center">
                            <a href="{{ route('AdminController.indexInsuranceCompany') }}"
                                class="text-decoration-none text-dark"><img src="{{ asset('assets/image/company.png') }}"
                                    class="menu_image">
                                ບໍລິສັດປະກັນໄພ</a>
                        </div>
                        {{-- End Insurance Company Link --}}

                        {{-- Insurance Level Link --}}
                        <div class="col-md-3 text-center">
                            <a href="{{ route('AdminController.indexInsuranceLevel') }}"
                                class="text-decoration-none text-dark"><img src="{{ asset('assets/image/level.png') }}"
                                    class="menu_image">
                                ຊັ້ນປະກັນໄພ</a>
                        </div>
                        {{-- End Insurance Level Link --}}

                        {{-- Vehicle Link --}}
                        <div class="col-md-3 text-center">
                            <a href="{{ route('AdminController.indexVehicleType') }}"
                                class="text-decoration-none text-dark"><img
                                    src="{{ asset('assets/image/vehicle_type.png') }}" class="menu_image">
                                ປະເພດຍານພາຫະນະ</a>
                        </div>
                        {{-- End Vehicle Link --}}

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('AdminController.indexVehicleDetail') }}"
                                class="text-decoration-none text-dark"><img src="{{ asset('assets/image/car_body.png') }}"
                                    class="menu_image">
                                ຕົວເລືອກປະເພດລົດ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Basic Information Category --}}

    <div class="pt-2"></div>

    {{-- Package and Insurance Categories --}}
    <div class="row p-3">
        <div class="col-md-12 ">
            <div class="card notosanLao shadow">
                <div class="card-header bg-white">
                    <h5 class="card-title text-dark"><i class="bi bi-dash"></i> ປະກັນໄພບຸກຄົນທີ ສາມ</h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        {{-- Create New Third Party Insurance Info Link --}}
                        <div class="col-md-3 mb-5 text-center">
                            <a href="{{ route('ThirdPartyInsuranceController.create') }}"
                                class="text-decoration-none text-dark">
                                <img src="{{ asset('assets/image/third_party.png') }}" class="menu_image"><br>
                                ສ້າງຮູບແບບປະກັນໄພບຸກຄົນທີ 3 ອັນໃໝ່</a>
                        </div>
                        {{-- End Create New Third Party Insurance Info Link --}}

                        {{-- Adjust Third Party Insurance Link --}}
                        <div class="col-md-3 mb-5 text-center">
                            <a href="{{ route('ThirdPartyInsuranceController.index') }}"
                                class="text-decoration-none text-dark">
                                <img src="{{ asset('assets/image/adjust.png') }}" class="menu_image"><br>
                                ກຳນົດຮູບແບບປະກັນໄພບຸກຄົນທີ 3</a>
                        </div>
                        {{-- End Adjust Third Party Insurance Link --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Package and Insurance Categories --}}

    {{-- Package Insurace for Vehicle --}}
    {{-- <div class="row p-3">
        <div class="col-md-12 ">
            <div class="card notosanLao shadow">
                <div class="card-header bg-white">
                    <h5 class="card-title text-dark"><i class="bi bi-dash"></i>ປະກັນໄພຍາພາຫະນະ</h5>
                </div>
                <div class="card-body">
                    <div class="row">
               
                        <div class="col-md-3 mb-5 text-center">
                            <a href="{{ route('AdminController.createVehiclePackage') }}"
                                class="text-decoration-none text-dark"><img src="{{ asset('assets/image/new.png') }}"
                                    class="menu_image">
                                <br>ສ້າງຮູບແບບປະກັນໄພຍານພາຫະນະອັນໃໝ່</a>
                        </div>
                   
                        <div class="col-md-3 mb-5 text-center">
                            <a href="{{ route('AdminController.createVehiclePackage') }}"
                                class="text-decoration-none text-dark"><img
                                    src="{{ asset('assets/image/insurance_info.png') }}" class="menu_image">
                                <br>ຮູບແບບປະກັນໄພ</a>
                        </div>
                   
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- End Package Insurance for Vehicle --}}

    {{-- Package and Insurance for Heath --}}
    <div class="row p-3">
        <div class="col-md-12 ">
            <div class="card notosanLao shadow">
                <div class="card-header bg-white">
                    <h5 class="card-title text-dark"><i class="bi bi-dash"></i>ປະກັນໄຟອຸບັດຕິເຫດ</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Create New Heath Cover Type --}}
                        <div class="col-md-3 mb-5 text-center">
                            <a href="{{ route('AdminController.heathCoverType') }}"
                                class="text-decoration-none text-dark"><img src="{{ asset('assets/image/new.png') }}"
                                    class="menu_image">
                                <br>ສ້າງປະເພດການຄຸ້ມຄອງ</a>
                        </div>

                        <div class="col-md-3 mb-5 text-center">
                            <a href="{{route('AccidentCoverItemController@index')}}"
                                class="text-decoration-none text-dark">
                                <img src="{{ asset('assets/image/adjust.png') }}" class="menu_image"><br>
                                ກຳນົດລາຍການທີ່ຄຸ້ມຄອງ</a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Package and Insurance for Heath --}}
@endsection

@section('styles')
    <style>
        .menu_image {
            width: auto;
            height: 70px;
        }

    </style>
@endsection
