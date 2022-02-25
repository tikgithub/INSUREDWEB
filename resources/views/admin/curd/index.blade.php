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
                        <div class="col-md-3 text-center">
                            <a href="{{route('AdminController.indexCarbrand')}}"><img src="{{ asset('assets/image/brand.png') }}" class="menu_image">
                                ຍີ່ຫໍ້ລົດ</a>
                        </div>
                        {{-- End Car Brand Link --}}

                        {{-- Insurance Company Link --}}
                        <div class="col-md-3 text-center">
                            <a href="{{route('AdminController.indexInsuranceCompany')}}"><img src="{{ asset('assets/image/company.png') }}" class="menu_image">
                                ບໍລິສັດປະກັນໄພ</a>
                        </div>
                        {{-- End Insurance Company Link --}}

                        {{-- Insurance Level Link --}}
                        <div class="col-md-3 text-center">
                            <a href="{{route('AdminController.indexInsuranceLevel')}}"><img src="{{ asset('assets/image/level.png') }}" class="menu_image">
                                ຊັ້ນປະກັນໄພ</a>
                        </div>
                        {{-- End Insurance Level Link --}}

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
