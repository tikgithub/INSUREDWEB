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
    @yield('styles')

    <title>{{ config('app.name') }}</title>

</head>

<body style="padding-bottom: 100px; padding-top:40px; background-color: #f0f0f0">
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-blue fixed-top" style="padding:0px;">
        <div class="container">
            <a class="navbar-brand" href="#">
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
                        <a class="nav-link active " aria-current="page" href="{{ route('welcome') }}">ໜ້າຫຼັກ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('InsuranceFlowController.showInsuranceTypeSelection')}}">ຊື້ປະກັນໄພ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">ຮູບແບບປະກັນໄພ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">ຂັ້ນຕອນການຊື້ປະກັນໄພ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">ຄູ່ຮ່ວມປະກັນໄພ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">ຕິດຕໍ່ພວກເຮົາ</a>
                    </li>
                </ul>
                <div class="d-flex  notosanLao">
                    {{-- Check user is login --}}
                    @if (Auth::check())
                        {{-- Drop down item --}}
                        <!-- Example single danger button -->
                        <div class="btn-group ">
                            <button type="button" class="text-white btn btn-lg bg-blue dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->profile_photo ? asset(Auth::user->profile_photo) : asset('assets/image/user_thumnail.png') }}"
                                    class="rounded-circle border" style="width: auto;height: 60px; object-fit: cover">
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            </button>
                            <ul class="dropdown-menu notosanLao">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> ໂປຣໄຟຣ</a></li>
                                <li><a class="dropdown-item" href="{{route('UserController.userListInsurance')}}"><i class="bi bi-list-task"></i> ລາຍການຊື້ປະກັນ</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                {{-- Admin Checked --}}
                                @if (Auth::user()->role == 'admin')
                                    <li><a class="dropdown-item" href="{{route('AdminController.showAdminDashBoard')}}"><i class="bi bi-hdd-network-fill"></i> Go to BackEnd</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif
                                <li><a class="dropdown-item"
                                        href="{{ route('UserController.logOut') }}"><i class="bi bi-power"></i> ອອກຈາກລະບົບ</a></li>
                            </ul>
                        </div>
                    @else
                        {{-- If the current route is login page then show register button --}}
                        @if (Request::url() === route('UserController.showLoginPage'))
                            <a href="{{ route('UserController.showRegisterPage') }}"
                                class="btn bg-blue border text-white">
                                <i class="bi bi-lock"></i> ລົງທະບຽນ
                            </a>
                            {{-- If the current route is register then show login button --}}
                        @elseif(Request::url() === route('UserController.showRegisterPage'))
                            <a href="{{ route('UserController.showLoginPage') }}"
                                class="btn bg-blue border text-white">
                                <i class="bi bi-lock"></i> ເຂົ້າສູ່ລະບົບ
                            </a>
                        @else
                            <a href="{{ route('UserController.showLoginPage') }}"
                                class="btn bg-blue border text-white">
                                <i class="bi bi-lock"></i> ເຂົ້າສູ່ລະບົບ
                            </a>
                        @endif
                    @endif

                    </a>
                </div>

            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    {{-- End NavBar --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    {{-- MC Date Picker script --}}
    <script src="https://cdn.jsdelivr.net/npm/mc-datepicker/dist/mc-calendar.min.js"></script>
    @yield('scripting')
</body>

</html>
