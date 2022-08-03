@extends('layouts.public_layout')
@section('content')

    <div class="pt-5"></div>
    <div class="row notosanLao">
        <div class="col-md-12">
            <h3 class="text-center">ລາຍການປະກັນໄພບຸກຄົ້ນທີ 3</h3>
        </div>
    </div>

    {{-- Show Level detail --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" href="{{ route('welcome') }}">ໜ້າຫຼັກ</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">ປ້ອນຂໍ້ມູນ</li>
        </ol>
    </nav>
    <hr>

    <div class="row notosanLao">
        <div class="col-md-4 mx-auto">
            <div class="pt-5"></div>
            <div class="card mb-3" style="width: 25rem">
                <img src="{{ asset($package->logo) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $package->package_name }}</h5>
                    <p class="card-text">{{ $package->vehicle_types }} {{ $package->vehicle_details }}</p>
                    <p class="card-text text-danger fw-bold fs-4">₭ {{ number_format($package->final_price, 0) }}</p>
                    <p class="card-text text-center">
                    <table class="table table-sm table-hover bg-white">
                        <thead>
                            <th>ລາຍການ</th>
                            <th class="text-end">ວົງເງິນຄຸ້ມຄອງ</th>
                        </thead>
                        <tbody>
                            @foreach ($coverDetail as $item)
                                <tr>
                                    <th>{{ $item->name }}</th>
                                    <th class="text-end">{{ number_format($item->price, 0) }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            {{-- FlashMessage --}}
            @include('flashMessage')
            @if (Auth::check())
                <h4 class="text-center">ປ້ອນຂໍ້ມູນປະກັນໄພ</h4>
                <form autocomplete="off" method="POST"
                    action="{{ route('InsuranceFlowController.thirdPartyStoreInput') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <fieldset class="border notosanLao">
                        <legend class="bg-blue">- ຜູ້ເອົາປະກັນ</legend>
                        {{-- Padding Legend --}}
                        <div class="p-2">
                            {{-- Firstname --}}
                            <div class="mb-3 row">
                                <label for="firstname" class="col-sm-4 fs-4 text-center col-form-label">ຊື່</label>
                                <div class="col-sm-8">
                                    <input type="text" required
                                        class="form-control form-control-lg {{ $errors->has('firstname') ? 'border-danger' : '' }}"
                                        id="firstname" name="firstname" value="{{ old('firstname') }}">
                                </div>
                            </div>
                            {{-- Lastname --}}
                            <div class="mb-3 row">
                                <label for="lastname" class="col-sm-4 fs-4 text-center col-form-label">ນາມສະກຸນ</label>
                                <div class="col-sm-8">
                                    <input type="text" required
                                        class="form-control form-control-lg {{ $errors->has('lastname') ? 'border-danger' : '' }}"
                                        id="lastname" name="lastname" value="{{ old('lastname') }}">
                                </div>
                            </div>

                            {{-- Sex --}}
                            <div class="mb-3 row">
                                <label for="sex" class="col-sm-4  fs-4 text-center col-form-label">ເພດ</label>
                                <div class="col-sm-8">
                                    <select name="sex" id="sex" required
                                        class="form-select form-select-lg {{ $errors->has('sex') ? 'border-danger' : '' }}">
                                        <option value="">ເລືອກ</option>
                                        <option value="M">ຊາຍ</option>
                                        <option value="F">ຍິງ</option>
                                    </select>
                                </div>
                            </div>
                            {{-- For display date picker dialog --}}
                            <div id="dtBox"></div>

                            {{-- DOB --}}
                            <div class="mb-3 row">
                                <label for="dob" class="col-sm-4 text-center fs-4 col-form-label">ວັນເກີດ</label>
                                <div class="col-sm-8">

                                    <input type="date" required data-field="date"
                                        class="form-control form-control-lg {{ $errors->has('dob') ? 'border-danger' : '' }}"
                                        id="dob" name="dob" value="{{ old('dob') }}">
                                </div>
                            </div>

                            {{-- Telephone --}}
                            <div class="mb-3 row">
                                <label for="tel" class="col-sm-4 text-center fs-4 col-form-label">ເບີໂທຕິດຕໍ່</label>
                                <div class="col-sm-8">
                                    <input type="hidden" id="country_code" name="country_code">
                                    <input type="text" id="phone"
                                        class="form-control form-control-lg {{ $errors->has('tel') ? 'border-danger' : '' }}"
                                        name="tel" value="{{ old('tel') }}" required />

                                </div>
                            </div>

                            {{-- Password Or Identity ID --}}
                            <div class="mb-3 row">
                                <label for="identity"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກທີ່ບັດປະຊາຊົນ ຫຼື້
                                    ເລກທີ Passport</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" required
                                        class="form-control form-control-lg {{ $errors->has('identity') ? 'border-danger' : '' }}"
                                        id="identity" name="identity" value="{{ old('identity') }}">
                                </div>
                            </div>
                            <hr>
                            {{-- Insured Address --}}
                            {{-- Province --}}
                            <div class="mb-3 row">
                                <label for="province" class="col-sm-4 text-center fs-4 col-form-label">ແຂວງ</label>
                                <div class="col-sm-8">
                                    <select name="province" id="province" required
                                        class="form-select form-select-lg {{ $errors->has('province') ? 'border-danger' : '' }}"
                                        onchange="onSelectInsuredProvince()" onfocus="this.selectedIndex = -1">
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id }}">{{ $item->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- District --}}
                            <div class="mb-3 row">
                                <label for="district" class="col-sm-4 text-center fs-4 col-form-label ">ເມືອງ</label>
                                <div class="col-sm-8">
                                    <select name="district" id="district" required
                                        class="form-select form-select-lg {{ $errors->has('district') ? 'border-danger' : '' }}"
                                        disabled></select>
                                </div>
                            </div>
                            {{-- Village Name --}}
                            <div class="mb-3 row">
                                <label for="address"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label ">ບ້ານ
                                    ແລະ
                                    ທີ່ຢູ</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" required
                                        class="form-control form-control-lg {{ $errors->has('address') ? 'border-danger' : '' }}"
                                        id="address" name="address" value="{{ old('address') }}">
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
                                <label for="vehicleBrand"
                                    class="col-sm-4 text-center fs-4 col-form-label">ຍີຫໍ້ລົດ</label>
                                <div class="col-sm-8">
                                    <select name="vehicleBrand" id="vehicleBrand" required
                                        class="form-select form-select-lg {{ $errors->has('vehicleBrand') ? 'border-danger' : '' }}">
                                        @foreach ($vehicleBrand as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Select Plate type --}}
                            <div class="mb-3 row">
                                <label for="plate"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label">ປະເພດປ້າຍ</label>
                                <div class="col-sm-8 align-self-center">
                                    <select name="plateType" id="plateType"
                                        class="form-select form-select-lg {{ $errors->has('plateType') ? 'border-danger' : '' }}">
                                        @foreach ($plateTypes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            {{-- Number plate --}}
                            <div class="mb-3 row">
                                <label for="number_plate"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກທະບຽນ</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" required
                                        class="form-control form-control-lg {{ $errors->has('number_plate') ? 'border-danger' : '' }}"
                                        id="number_plate" name="number_plate" value="{{ old('number_plate') }}">
                                </div>
                            </div>
                            {{-- Color --}}
                            <div class="mb-3 row">
                                <label for="color"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label">ສີ</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" required
                                        class="form-control form-control-lg {{ $errors->has('color') ? 'border-danger' : '' }}"
                                        id="color" name="color" value="{{ old('color') }}">
                                </div>
                            </div>
                            {{-- Engine Number --}}
                            <div class="mb-3 row">
                                <label for="color"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກຈັກ</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" required
                                        class="form-control form-control-lg {{ $errors->has('engine_number') ? 'border-danger' : '' }}"
                                        id="engine_number" name="engine_number" value="{{ old('engine_number') }}">
                                </div>
                            </div>

                            {{-- Chassic Number --}}
                            <div class="mb-3 row">
                                <label for="color"
                                    class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກຖັງ</label>
                                <div class="col-sm-8 align-self-center">
                                    <input type="text" required
                                        class="form-control form-control-lg {{ $errors->has('chassic_number') ? 'border-danger' : '' }}"
                                        id="chassic_number" name="chassic_number" value="{{ old('chassic_number') }}">
                                </div>
                            </div>

                            {{-- Province Registered --}}
                            <div class="mb-3 row">
                                <label for="registeredProvince"
                                    class="col-sm-4 text-center fs-4 col-form-label">ແຂວງທີ່ຂຶ້ນທະບຽນ</label>
                                <div class="col-sm-8">
                                    <select name="registeredProvince" id="registeredProvince" required
                                        class="form-select form-select-lg {{ $errors->has('registeredProvince') ? 'border-danger' : '' }}">
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id }}">{{ $item->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 fs-4">
                                <label for="district" class="col-form-label col-sm-3">ຮູບຖ່າຍບັດປະຈຳໂຕ ຫຼື
                                    ໜັງສືຜ່ານແດນ<span class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9 align-self-center text-center">
                                    <input type="file" name="reference_photo" id="reference_photo"
                                        class="form-control-file" hidden onchange="onPreviewChange()">
                                    <button type="button" onclick="selectPhotoOnClick()"
                                        class="btn btn-warning btn-lg mb-2"><i class="bi bi-image-alt"></i>
                                        ເລືອກຮູບ</button>
                                    <img id="img_preview" src="" alt="" srcset=""
                                        class="border rounded img-fluid">
                                </div>
                            </div>


                            {{-- Submit Botton --}}
                            <div class="mb-3 row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="submit" class="btn bg-blue btn-lg text-white"><i
                                            class="bi bi-download"></i>
                                        ຕົກລົງ</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            @else
                <h4 class="text-center">ທ່ານຍັງບໍ່ໄດ້ເຂົ້າສູ່ລະບົບ</h4>
                {{-- Login Session --}}
                <form action="{{ route('UserController.validateUserBeforeBuying') }}" method="post"
                    class="notosanLao shadow pt-4 p-3 mx-auto text-center" style="width: 400px">
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
            @endif

        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
@section('styles')
    <style>
        #feedback {
            font-size: 1.4em;
        }

        #selectable .ui-selecting {
            background: #FECA40;
        }

        #selectable .ui-selected {
            background: #F39814;
            color: white;
        }

        #selectable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 60%;
        }

        #selectable li {
            margin: 3px;
            padding: 0.4em;
            font-size: 1.4em;
            height: 18px;
        }
    </style>
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
                        for (let i = 0; i < data.length; i++) {
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

        function selectPhotoOnClick() {
            document.getElementById('reference_photo').click();
        }

        function onPreviewChange() {
            var inputPhoto = document.getElementById('reference_photo');
            var fileReader = new FileReader();
            fileReader.readAsDataURL(inputPhoto.files[0]);
            fileReader.onload = function(event) {
                document.getElementById('img_preview').src = event.target.result;
            };
        }
        // Date time picker script
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: "la",
            autoPlaceholder: 'aggressive',
            utilsScript: "{{ asset('assets/telinput/js/utils.js') }}",
        });

        function onSelectCountry() {
            console.log(iti.getSelectedCountryData());
            document.getElementById("country_code").value = "+" + iti.getSelectedCountryData().dialCode;

        }
    </script>
@endsection
