@extends('layouts.public_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 fw-bold fs-3 text-center">
            ລາຍການປະກັນໄພຂອງທ່ານ {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
        </div>
    </div>
    <div class="pt-3"></div>
    <div class="w3-bar w3-black text-center">
        @if (isset($vehicleInsurance))
            <button class="btn btn-lg bg-blue text-white mt-2" onclick="openCity('vihecle')">ປະກັນໄພຍານພາຫະນະ</button>
        @endif
        @if (isset($vehicleInsurance))
            <button class="btn btn-lg bg-blue text-white mt-2" onclick="openCity('thirdParty')">ປະກັນໄພບຸກຄົນທີສາມ</button>
        @endif
        @if (isset($accidentInsurance))
            <button class="btn btn-lg bg-blue text-white mt-2" onclick="openCity('accident')">ປະພັນໄພອຸບັດຕິເຫດ</button>
        @endif
        @if (isset($heathInsurance))
            <button class="btn btn-lg bg-blue text-white mt-2" onclick="openCity('heath')">ປະກັນໄພສຸຂະພາບ</button>
        @endif

    </div>
    <div class="pt-5"></div>
    <div id="vihecle" class="tab">
        {{-- Display Vehicle Insurance detail --}}

        <div class="row">
            <div class="col-md-12 pt-1 bg-blue">
                <h3 class="text-white">ປະກັນໄພຍານພາຫະນະ</h3>
            </div>
        </div>
        @foreach ($vehicleInsurance as $item)
            <a class="row text-decoration-none text-dark mouse-over pt-2"
                href="{{ route('UserController.showVehicleInsuranceDetailPage', ['id' => $item->insurance_id]) }}"
                style="cursor: pointer">
                <div class="col-md-4 text-center ">
                    <img src="{{ asset($item->company_logo) }}" alt="{{ $item->company_name }}"
                        class="company-logo border">
                    <h4 class="mt-2">

                        <b>{{ $item->company_name }}</b><br><br>{{ $item->level_name }}<br>{{ $item->package_name }}
                        {{ $item->option_name }}
                    </h4>
                </div>
                <div class="col-md-4 text-center align-self-center">

                    <span style="" class="fs-2 fw-bold text-danger"><u>{{ $item->number_plate }}</u></span> <br>
                    <span class="fs-4 fr-line">{{ $item->registeredProvince }}</span>

                </div>
                <div class="col-md-4 text-center align-self-center mt-2">

                    @include('user_view.alertComponent')

                </div>
            </a>
            <hr>
        @endforeach

    </div>


    <div id="thirdParty" class="tab" style="display:none">
        {{-- Display ThirdParty Insurance Detail --}}
        <div class="row ">
            <div class="col-md-12 pt-1 bg-blue">
                <h3 class="text-white">ປະກັນໄພບຸກຄົນທີ 3</h3>
            </div>
        </div>
        @foreach ($thirdPartyInsurance as $item)
            <a class="row text-decoration-none text-dark mouse-over pt-2" href="" style="cursor: pointer">
                <div class="col-md-4 text-center ">
                    <img src="{{ asset($item->company_logo) }}" alt="{{ $item->company_name }}"
                        class="company-logo border">
                    <h4 class="mt-2">

                        <b>{{ $item->company_name }}</b><br><br>{{ $item->level_name }}<br>{{ $item->package_name }}
                        {{ $item->option_name }}
                    </h4>
                </div>
                <div class="col-md-4 text-center align-self-center">

                    <span style="" class="fs-2 fw-bold text-danger"><u>{{ $item->number_plate }}</u></span> <br>
                    <span class="fs-4 fr-line">{{ $item->registeredProvince }}</span>

                </div>
                <div class="col-md-4 text-center align-self-center mt-2">
                    @include('user_view.alertComponent')
                </div>
            </a>
            <hr>
        @endforeach

    </div>

    <div id="accident" class="tab" style="display:none">
         {{-- Display ThirdParty Insurance Detail --}}
         <div class="row ">
            <div class="col-md-12 pt-1 bg-blue">
                <h3 class="text-white">ປະກັນໄພອຸບັດຕິເຫດ</h3>
            </div>
        </div>
        @foreach ($accidentInsurance as $item)
        <a class="row text-decoration-none text-dark mouse-over pt-2" href="" style="cursor: pointer">
            <div class="col-md-4 text-center ">
                <img src="{{ asset($item->company_logo) }}" alt="{{ $item->company_name }}"
                    class="company-logo border">
                <h4 class="mt-2">

                    <b>{{ $item->company_name }}</b><br>{{ $item->package_name }}
                    
                </h4>
            </div>
            <div class="col-md-4 text-center align-self-center">

                <span style="" class="fs-2 fw-bold text-danger"><u>{{$item->insuredName}}</u></span> <br>
                <span class="fs-4 fr-line">{{$item->province}}</span>

            </div>
            <div class="col-md-4 text-center align-self-center mt-2">
                @include('user_view.alertComponent')
            </div>
        </a>
        <hr>
    @endforeach
    </div>

    <div id="heath" class="tab" style="display: none">
        <h2>heath</h2>
    </div>

    {{-- Display Insurance Accident Insurance Detail --}}
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('scripting')
    <script>
        function openCity(cityName) {
            var i;
            var x = document.getElementsByClassName("tab");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
        }
    </script>
@endsection


@section('style')
    <style>
        .company-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .vehicle-image {
            width: auto;
            height: 100px;
            object-fit: cover;
        }

        .mouse-over:hover {
            background-color: #ccc;
        }

        .tab {
            background-color: #fff;
            border-color: #fff;
        }

    </style>
@endsection
