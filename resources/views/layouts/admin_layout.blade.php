@php
use App\Models\MessageToUs;
use Illuminate\Support\Facades\DB;

@endphp
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    {{-- Date Picker Third Party MC Date Picker --}}
    <link href="https://cdn.jsdelivr.net/npm/mc-datepicker/dist/mc-calendar.min.css" rel="stylesheet" />

    {{-- Toastr CDN --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('assets/telinput/css/intlTelInput.css')}}" />
    <script src="{{asset('assets/telinput/js/intlTelInput.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/datepciker/DateTimePicker.css') }}">

    <title>{{ config('app.name') }}</title>
    <style>
        .sidenav {
            height: 100%;
            width: 260px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #3d3d3d;
            overflow-x: hidden;
            padding-top: 80px;
        }

        .sidenav a {
            padding: 10px 8px 10px 16px;
            text-decoration: none;
            font-size: 15pt;
            display: block;
            color: #fff;
        }

        .sidenav a:hover {
            color: #000;
            background-color: #f0f0f0;
        }

        .main {
            margin-left: 260px;

            /* Increased text to enable scrolling */
            padding: 0px 8px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        .side-nav-item {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .sidehover {
            background-color: #f0f0f0;
        }

    </style>
    @yield('styles')

</head>

<body style="padding-bottom: 100px; padding-top:40px; background-color: white" class="notosanLao">
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-blue fixed-top" style="padding:0px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('assets/image/mainlogo.png') }}" width="auto" height="64" class="d-inline-block ">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 notosanLao fs-5">
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page" href="{{ route('welcome') }}">ລະບົບບໍລີຫານຈັດ
                            {{ config('app.name') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-light active ms-5 position-relative text-dark" href="{{route('MessageToUsController.ViewMessage')}}">
                            <i class="bi bi-envelope me-2"></i> ກ່ອງຂໍ້ຄວາມ
                            @php
                                $unReadCount = collect(DB::select('select count(id) as counter from messages_to_us where status = 0; '))->first();

                            @endphp
                            @if ($unReadCount->counter > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{$unReadCount->counter}}
                                </span>
                            @endif


                        </a>
                    </li>

                </ul>
                <div class="d-flex  notosanLao">

                    <div class="btn-group ">
                        <button type="button" class="text-white btn btn-lg bg-blue dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profile_photo ? asset(Auth::user()->profile_photo) : asset('assets/image/user_thumnail.png') }}"
                                class="rounded-circle border" style="width: 50px;height: 50px; object-fit: cover">
                            {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                        </button>
                        <ul class="dropdown-menu notosanLao">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> ໂປຣໄຟຣ</a></li>
                            <li><a class="dropdown-item" href="{{ route('UserController.logOut') }}"><i
                                        class="bi bi-power"></i> ອອກຈາກລະບົບ</a></li>
                        </ul>
                    </div>
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <div class="sidenav notosanLao">
        {{-- Menu Index DashBoard --}}
        <a href="{{ route('AdminController.showNewAdminDashBoard') }}" @php
            if (Request::url() == route('AdminController.showNewAdminDashBoard')) {
                echo "class='text-dark bg-white'";
            }
        @endphp>
            <i class="bi bi-pie-chart-fill me-2"></i> ໜ້າຫຼັກ</a>
        {{-- End Menu Index DashBoard --}}

        {{-- Padding HR --}}
        <hr style="color: #fff">

        {{-- Menu Index Of Website Information --}}
        <a href="{{ route('AdminController.showInsuranceList') }}"
            class="{{ Request::url() == route('AdminController.showInsuranceList') ? 'text-dark bg-white' : '' }}"><i
                class="bi bi-envelope-paper me-2"></i> ກວດສອບລາຍການປະກັນໄພ</a>
        {{-- End Menu Index Of Website Information --}}

        {{-- Menu Index Datamanager --}}
        <a href="{{ route('AdminController.indexDataManager') }}" @php
            if (strpos(Request::url(), 'datamanager')) {
                echo "class='text-dark bg-white'";
            }
        @endphp>
            <i class="bi bi-hdd-fill me-2"></i>
            ຈັດການຂ້ໍມູນ</a>
        {{-- End Menu Index DataMananger --}}

        {{-- Menu Index Of Website Information --}}
        <a href="{{ route('WebsiteController.index') }}"
            class="{{ Request::url() == route('WebsiteController.index') ? 'text-dark bg-white' : '' }}"><i
                class="bi bi-file-break-fill me-2"></i> ຂໍ້ມູນໜ້າເວັບໄຊ</a>
        {{-- End Menu Index Of Website Information --}}

        {{-- Padding HR --}}
        <hr style="color: #fff">

        {{-- Menu Index Of Reporting System --}}
        <a href="#contact"><i class="bi bi-file-earmark-text-fill me-2"></i> ລາຍງານລະບົບ</a>
        {{-- End Menu Reporting System --}}
    </div>
    <div class="main">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    {{-- End NavBar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/js/toastr.js') }}"></script>
    <script src="{{ asset('assets/datepciker/DateTimePicker.js') }}"></script>
    <script src="{{ asset('assets/datepciker/i18n/DateTimePicker-i18n.js') }}"></script>
    <script>
        $(document).ready(function() {

            $("#dtBox").DateTimePicker({
                'setButtonContent': 'ຕົກລົງ',
                'clearButtonContent': 'ອອກ',
                'titleContentDate': 'ເລືອກວັນທີ',
                'dateFormat':'dd-MM-yyyy',
                'buttonsToDisplay':["HeaderCloseButton", "SetButton"]
            });

        });
    </script>
    @yield('scripting')

</body>

</html>
