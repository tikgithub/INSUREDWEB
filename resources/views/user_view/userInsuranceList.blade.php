@extends('layouts.public_layout')
@section('content')
    <div class="pt-3">

    </div>
    <div class="row">
        <div class="col-md-12 fw-bold fs-3 text-center">
            ລາຍການປະກັນໄພຂອງທ່ານ {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
        </div>
    </div>
    {{-- Display Vehicle Insurance detail --}}
    @if (isset($vehicleInsurance))
        <div class="row">
            <div class="col-md-12 pt-1 bg-blue">
                <h3 class="text-white">ປະກັນໄພຍານພາຫະນະ</h3>
            </div>
        </div>
    @endif
    <hr>
    @foreach ($vehicleInsurance as $item)
        <a class="row text-decoration-none text-dark mouse-over pt-2"
            href="{{ route('UserController.showVehicleInsuranceDetailPage', ['id' => $item->insurance_id]) }}"
            style="cursor: pointer">
            <div class="col-md-4 text-center ">
                <img src="{{ asset($item->company_logo) }}" alt="{{ $item->company_name }}" class="company-logo border">
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
        <div class="pt-2"></div>
    @endforeach


    {{-- Display ThirdParty Insurance Detail --}}
    @if (isset($vehicleInsurance))
        <div class="row ">
            <div class="col-md-12 pt-1 bg-blue">
                <h3 class="text-white">ປະກັນໄພບຸກຄົນທີ 3</h3>
            </div>
        </div>
        <hr>
    @endif

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
        <div class="pt-2"></div>
    @endforeach

    <div class="w3-bar w3-black">
        <button class="w3-bar-item w3-button" onclick="openCity('vihecle')">ປະກັນໄພຍານພາຫະນະ</button>
        <button class="w3-bar-item w3-button" onclick="openCity('thirdParty')">ປະກັນໄພບຸກຄົນທີສາມ</button>
        <button class="w3-bar-item w3-button" onclick="openCity('accident')">ປະພັນໄພອຸບັດຕິເຫດ</button>
        <button class="w3-bar-item w3-button" onclick="openCity('heath')">ປະກັນໄພສຸຂະພາບ</button>
    </div>
    <div id="vihecle" class="tab">
        <h2>London</h2>
        <p>London is the capital of England.</p>
    </div>

    <div id="thirdParty" class="tab" style="display:none">
        <h2>Paris</h2>
        <p>Paris is the capital of France.</p>
    </div>

    <div id="accident" class="tab" style="display:none">
        <h2>Tokyo</h2>
        <p>Tokyo is the capital of Japan.</p>
    </div>

    <div id="heath" class="tab" style="display: none">
        <h2>heath</h2>
    </div>

    {{-- Display Insurance Accident Insurance Detail --}}
@endsection
{{-- @section('footer')
    @include('layouts.footer')
@endsection --}}

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
        .tab{
            background-color: #fff;
            border-block-color: #fff;
        }

    </style>
@endsection
