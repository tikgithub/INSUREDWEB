@extends('layouts.public_layout')
@section('content')
    <div class="pt-5"></div>
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="notosanLao">
                ເພິ່ມຂໍ້ມູນປະກັນໄພ
            </h2>
        </div>
    </div>
    <div class="pt-3"></div>
    {{-- End Header --}}
    {{-- Show Level detail --}}
    <nav aria-label="breadcrumb" class="pt-3 text-white">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">ໜ້າຫຼັກ</a></li>

            <li class="breadcrumb-item"><a
                    href="{{ route('InsuranceFlowController.showInsuranceTypeSelection') }}">ຊື້ປະກັນໄພ</a></li>

            <li class="breadcrumb-item"><a
                    href="{{ route('InsuranceFlowController.showCarInsuranceSelectionMenu') }}">ເລືອກຮູບແບບປະກັນໄພ</a>
            </li>

            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ $level->name }}</a></li>

            <li class="breadcrumb-item active" aria-current="page">ປ້ອນຂໍ້ມູນ {{ $company->name }} {{ $level->name }}
                {{ $saleOption->name }}</li>
        </ol>
    </nav>
    <hr>
    {{-- Body Section --}}
    <div class="row">
        {{-- Insurance Detail --}}
        <div class="col-md-4">
            <div class="d-flex justify-content-center pt-5">
                <div class="card" style="width: 18.5rem;">
                    @if (!trim($company->logo))
                        <img src="{{ asset('assets/image/200x120.png') }}" class="rounded img-fluid me-2" alt="200x12"
                            srcset="" style="width: 300px; height: 200px;">
                    @else
                        <img src="{{ asset($company->logo) }}" alt="200x12" srcset="" style="width: 300px; height: 200px;"
                            class="rounded img-fluid me-2">
                    @endif
                    <div class="card-body notosanLao">

                        <h5 class="card-title">{{ $company->name }} {{ $vehiclePackage->name }}
                            ({{ $saleOption->name }})
                        </h5>
                        <p class="card-text text-danger text-center fs-3 fw-bolder">
                            {{ number_format($saleOption->sale_price, 0) }}</p>

                    </div>
                </div>
            </div>

            <div class="row pt-3">
                <div class="col-md-12">
                    <div class="d-grid gap-1">
                        <button class="btn btn-block bg-blue text-white notosanLao" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            ລາຍລະອຽດປະກັນໄພ
                        </button>
                    </div>
                    <div class="collapse show" id="collapseExample">
                        <table class="table table-sm notosanLao table-bordered">
                            <thead class="fs-5 bg-blue text-white">

                                <td>ລາຍລະອຽດການຄຸ່ມຄອງປະກັນໄພ</td>
                                <td>ວົງເງິນຄຸ່ມກັນ</td>

                            </thead>
                            <tbody>
                                @php
                                    $group_id = 0;
                                    
                                @endphp
                                @foreach ($saleDetails as $item)
                                    {{-- start tr --}}
                                    <tr>
                                        @if ($group_id != $item->group_id)
                                            <td colspan="3" class="fs-6 bg-warning fw-bolder">{{ $item->group_name }}
                                            </td>
                                    <tr>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ number_format($item->cover_price, 0) }} ₭</td>
                                    </tr>
                                @endif

                                @if ($group_id == $item->group_id)
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ number_format($item->cover_price, 0) }} ₭</td>
                                @endif
                                @php
                                    $group_id = $item->group_id;
                                @endphp
                                </tr>
                                {{-- End tr --}}
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        {{-- Information Input For customer --}}
        <div class="col-md-8">
            @if (!Auth::check())
                <div class="pt-4"></div>
                {{-- Login Panel Here --}}
                <h2 class="notosanLao text-center">ກາລຸນາເຂົ້າສູ່ລະບົບກ່ອນ</h2>
                {{-- Login Form --}}
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                        {{-- Padding --}}
                        <div class="pt-2"></div>
                        @include('flashMessage')
                        <form action="{{ route('UserController.validateUserBeforeBuying') }}" method="post"
                            class="notosanLao shadow pt-4 p-3">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                                <input type="email"
                                    class="form-control form-control-lg {{ $errors->has('email') ? 'border-danger' : '' }}"
                                    placeholder="ອີເມວ" aria-label="email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-asterisk"></i></span>
                                <input type="password"
                                    class="form-control form-control-lg {{ $errors->has('password') ? 'border-danger' : '' }}"
                                    placeholder="ລະຫັດຜ່ານ" aria-label="password" name="password">
                            </div>
                            @if ($errors->has('password'))
                                <div class="alert-danger notosanLao rounded mb-3 p-2">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <div class="mb-1">
                                <button type="submit" class="btn bg-blue btn-lg text-white"><i class="bi bi-key"></i>
                                    ຕົກລົງ</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                {{-- Padding --}}
                <div class="pt-1"> </div>
                <h2 class="notosanLao text-center">ປ້ອນຂໍ້ມູນ</h2>
                {{-- FlashMessage --}}
                @include('flashMessage')
                <form autocomplete="off" method="POST" action="{{route('InsuranceFlowController.storeInputFromCustomer')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="sale_id" value="{{$saleOption->id}}">
                    <fieldset class="border notosanLao">
                        <legend class="bg-blue">- ຜູ້ເອົາປະກັນ</legend>
                        {{-- Padding Legend --}}
                        <div class="p-2">
                            {{-- Firstname --}}
                            <div class="mb-3 row">
                                <label for="firstname" class="col-sm-4 fs-4 text-center col-form-label">ຊື່</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg {{($errors->has('firstname')? 'border-danger':'')}}" id="firstname" name="firstname"
                                        value="{{ old('firstname') }}">
                                </div>
                            </div>
                            {{-- Lastname --}}
                            <div class="mb-3 row">
                                <label for="lastname" class="col-sm-4 fs-4 text-center col-form-label">ນາມສະກຸນ</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg {{($errors->has('lastname')? 'border-danger':'')}}" id="lastname" name="lastname"
                                        value="{{ old('lastname') }}">
                                </div>
                            </div>

                            {{-- Sex --}}
                            <div class="mb-3 row">
                                <label for="sex" class="col-sm-4  fs-4 text-center col-form-label">ເພດ</label>
                                <div class="col-sm-8">
                                    <select name="sex" id="sex" class="form-select form-select-lg {{($errors->has('sex')? 'border-danger':'')}}">
                                        <option value="">ເລືອກ</option>
                                        <option value="M">ຊາຍ</option>
                                        <option value="F">ຍິງ</option>
                                    </select>
                                </div>
                            </div>

                            {{-- DOB --}}
                            <div class="mb-3 row">
                                <label for="dob" class="col-sm-4 text-center fs-4 col-form-label">ວັນເກີດ</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control form-control-lg {{($errors->has('dob')? 'border-danger':'')}}" id="dob" name="dob"
                                        value="{{ old('dob') }}">
                                </div>
                            </div>

                            {{-- Telephone --}}
                            <div class="mb-3 row">
                                <label for="tel" class="col-sm-4 text-center fs-4 col-form-label">ເບີໂທຕິດຕໍ່</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg {{($errors->has('tel')? 'border-danger':'')}}" id="tel" name="tel"
                                        value="{{ old('tel') }}">
                                </div>
                            </div>

                            {{-- Password Or Identity ID --}}
                            <div class="mb-3 row">
                                <label for="identity"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກທີ່ບັດປະຊາຊົນ ຫຼື້
                                    ເລກທີ Passport</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" class="form-control form-control-lg {{($errors->has('identity')? 'border-danger':'')}}" id="identity" name="identity"
                                        value="{{ old('identity') }}">
                                </div>
                            </div>
                            <hr>
                            {{-- Insured Address --}}
                            {{-- Province --}}
                            <div class="mb-3 row">
                                <label for="province" class="col-sm-4 text-center fs-4 col-form-label">ແຂວງ</label>
                                <div class="col-sm-8">
                                    <select name="province" id="province" class="form-select form-select-lg {{($errors->has('province')? 'border-danger':'')}}"
                                        onchange="onSelectInsuredProvince()" onfocus="this.selectedIndex = -1">
                                        @foreach ($Provinces as $item)
                                            <option value="{{ $item->id }}">{{ $item->province_name }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                            {{-- District --}}
                            <div class="mb-3 row">
                                <label for="district" class="col-sm-4 text-center fs-4 col-form-label " >ເມືອງ</label>
                                <div class="col-sm-8">
                                    <select name="district" id="district" class="form-select form-select-lg {{($errors->has('district')? 'border-danger':'')}}"
                                        disabled></select>
                                </div>
                            </div>
                            {{-- Village Name --}}
                            <div class="mb-3 row">
                                <label for="address"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label ">ບ້ານ ແລະ
                                    ທີ່ຢູ</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" class="form-control form-control-lg {{($errors->has('address')? 'border-danger':'')}}" id="address" name="address"
                                        value="{{ old('address') }}">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    {{-- Fieldset of insured Address --}}
                    <fieldset class="border notosanLao">
                        <legend class="bg-blue">- ຂໍ້ມູນລົດທີ່ຈະເອົາປະກັນ</legend>
                        <div class="p-2">
                            {{-- VehicleBrand --}}
                            <div class="mb-3 row">
                                <label for="vehicleBrand" class="col-sm-4 text-center fs-4 col-form-label">ຍີຫໍ້ລົດ</label>
                                <div class="col-sm-8">
                                    <select name="vehicleBrand" id="vehicleBrand" class="form-select form-select-lg {{($errors->has('vehicleBrand')? 'border-danger':'')}}">
                                        @foreach ($carBrands as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            {{-- Number plate --}}
                            <div class="mb-3 row">
                                <label for="number_plate"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກທະບຽນ</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" class="form-control form-control-lg {{($errors->has('number_plate')? 'border-danger':'')}}" id="number_plate"
                                        name="number_plate" value="{{ old('number_plate') }}">
                                </div>
                            </div>
                            {{-- Color --}}
                            <div class="mb-3 row">
                                <label for="color"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label">ສີ</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" class="form-control form-control-lg {{($errors->has('color')? 'border-danger':'')}}" id="color" name="color"
                                        value="{{ old('color') }}">
                                </div>
                            </div>
                            {{-- Province Registered --}}
                            <div class="mb-3 row">
                                <label for="registeredProvince"
                                    class="col-sm-4 text-center fs-4 col-form-label">ແຂວງທີ່ຂຶ້ນທະບຽນ</label>
                                <div class="col-sm-8">
                                    <select name="registeredProvince" id="registeredProvince"
                                        class="form-select form-select-lg {{($errors->has('registeredProvince')? 'border-danger':'')}}">
                                        @foreach ($Provinces as $item)
                                            <option value="{{ $item->id }}">{{ $item->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <h4 class="notosanLao text-center">
                                ຮູບພາບ
                            </h4>
                            <hr>
                            {{-- Car Side Front Image --}}
                            <div class="mb-3 row">
                                <div class="col-sm-4 text-center">
                                    ຮູບລົດດ້ານໜ້າ
                                    <img class="ms-2" src="{{asset('assets\image\car_front.png')}}" style="width: 50px; height: 50px;" alt="" srcset="">
                                </div>
                                <div class="col-sm-8 align-self-center">
                                    <input type="file" name="front" id="front" class="form-control-file border {{($errors->has('front')? 'border-danger':'')}}" style="width: 100%">
                                </div>
                            </div>

                             {{-- Car Side left Image --}}
                             <div class="mb-3 row">
                                <div class="col-sm-4 text-center">
                                    ຮູບລົດດ້ານຂ້າງຊ້າຍ
                                    <img class="ms-2" src="{{asset('assets\image\car_left.png')}}" style="width: 50px; height: 50px;" alt="" srcset="">
                                </div>
                                <div class="col-sm-8 align-self-center">
                                    <input type="file" name="left" id="left" class="form-control-file border {{($errors->has('left')? 'border-danger':'')}}" style="width: 100%">
                                </div>

                            </div>

                             {{-- Car Side right Image --}}
                             <div class="mb-3 row">
                                <div class="col-sm-4 text-center">
                                    ຮູບລົດດ້ານຂ້າງຂວາ
                                    <img class="ms-2" src="{{asset('assets\image\car_right.png')}}" style="width: 50px; height: 50px;" alt="" srcset="">
                                </div>
                                <div class="col-sm-8 align-self-center">
                                    <input type="file" name="right" id="right" class="form-control-file border {{($errors->has('right')? 'border-danger':'')}}" style="width: 100%">
                                </div>
                            </div>

                             {{-- Car Side rear Image --}}
                             <div class="mb-3 row">
                                <div class="col-sm-4 text-center">
                                    ຮູບລົດດ້ານຫຼັງ
                                    <img class="ms-2" src="{{asset('assets\image\car_rear.png')}}" style="width: 50px; height: 50px;" alt="" srcset="">
                                </div>
                                <div class="col-sm-8 align-self-center">
                                    <input type="file" name="rear" id="rear" class="form-control-file border {{($errors->has('rear')? 'border-danger':'')}}" style="width: 100%"> 
                                </div>
                            </div>

                            {{-- Car Book Image --}}
                            <div class="mb-3 row">
                                <div class="col-sm-4 text-center">
                                    ຮູບປື້ມເຫຼືອງ
                                    <img class="ms-2 rounded" src="{{asset('assets\image\yellow_book.png')}}" style="width: auto; height: 50px;" alt="" srcset="">
                                </div>
                                <div class="col-sm-8 align-self-center">
                                    <input type="file" name="yellow_book" id="yellow_book" class="form-control-file border {{($errors->has('yellow_book')? 'border-danger':'')}}" style="width: 100%"> 
                                </div>
                            </div>

                            {{-- Submit Botton --}}
                            <div class="mb-3 row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="submit" class="btn bg-blue btn-lg text-white"><i class="bi bi-download"></i> ຕົກລົງ</button>
                                </div>
                            </div>
                        </div>
                        
                    </fieldset>
                    
                </form>
            @endif
        </div>
    </div>
    <div class="fixed-bottom">
        @include('layouts.footer')
    </div>
@endsection
@section('scripting')
    <script>
        var baseURL = "{{ env('BASE_ROUTE') }}";
       
        //When Selected the Province of Insured
        function onSelectInsuredProvince() {
            var provinceInsuredSelect = document.getElementById('province');
            var provinceInsuredSelectValue = provinceInsuredSelect.options[provinceInsuredSelect.selectedIndex].value;
            //Get District on insured
            var districtInsuredSelect = document.getElementById('district');
            districtInsuredSelect.disabled = true;
            districtInsuredSelect.innerHTML = "";
            //Fetch data from API
            fetch(window.location.origin + baseURL + '/api/json/district/' + provinceInsuredSelectValue)
                .then(res => res.json())
                .then(data => {
                    if (data.length > 0) {
                        districtInsuredSelect.disabled = false;
                        for(let i = 0; i < data.length; i++){
                            var option = document.createElement('option');
                            option.text = data[i].district_name;
                            option.value = data[i].id;
                            districtInsuredSelect.appendChild(option);
                        }
                    }

                })
                .catch(error => {
                    console.log(error);
                });
        }
    </script>
@endsection
