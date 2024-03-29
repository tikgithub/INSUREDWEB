@php
use App\Utils\ImageServe;
@endphp
@extends('layouts.public_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row notosanLao">
        <div class="col-md-12">
            <h3 class="text-center">ຢຶນຢັນຂໍ້ມູນປະກັນໄພ</h3>
        </div>
    </div>
    {{-- Show Level detail --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" href="{{ route('welcome') }}">ໜ້າຫຼັກ</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">ຢຶນຢັນຂໍ້ມູນປະກັນໄພ</li>
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

                    <p class="card-text text-dark fw-bold fs-5">
                        ລວມຄ່າທຳນຽມ:{{ number_format($customerPackage->fee_charge, 0) }}</p>
                    <p class="card-text text-danger fw-bold fs-4">₭ {{ number_format($package->final_price, 0) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h3 class="text-center">ກວດຄືນຂໍ້ມູນປະກັນໄພ</h3>
            <div style="width: 500px; margin:auto" class="">
                @include('flashMessage')
            </div>
            <form autocomplete="off" method="POST" id="formSubmit"
                action="{{ route('InsuranceFlowController.updateConfirmThirdParty') }}" enctype="multipart/form-data">
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
                                    id="firstname" name="firstname" value="{{ $customerPackage->firstname }}">
                            </div>
                        </div>
                        {{-- Lastname --}}
                        <div class="mb-3 row">
                            <label for="lastname" class="col-sm-4 fs-4 text-center col-form-label">ນາມສະກຸນ</label>
                            <div class="col-sm-8">
                                <input type="text" required
                                    class="form-control form-control-lg {{ $errors->has('lastname') ? 'border-danger' : '' }}"
                                    id="lastname" name="lastname" value="{{ $customerPackage->lastname }}">
                            </div>
                        </div>

                        {{-- Sex --}}
                        <div class="mb-3 row">
                            <label for="sex" class="col-sm-4  fs-4 text-center col-form-label">ເພດ</label>
                            <div class="col-sm-8">
                                <select name="sex" id="sex" required
                                    class="form-select form-select-lg {{ $errors->has('sex') ? 'border-danger' : '' }}">
                                    <option value="M" {{ $customerPackage->sex == 'M' ? 'selected' : '' }}>ຊາຍ
                                    </option>
                                    <option value="F" {{ $customerPackage->sex == 'F' ? 'selected' : '' }}>ຍິງ
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- DOB --}}
                        <div class="mb-3 row">
                            <label for="dob" class="col-sm-4 text-center fs-4 col-form-label">ວັນເກີດ</label>
                            <div class="col-sm-8">
                                <div id="dtBox"></div>
                                <input type="text" required data-field="date"
                                    class="form-control form-control-lg {{ $errors->has('dob') ? 'border-danger' : '' }}"
                                    id="dob" name="dob"
                                    value="{{ date('d-m-Y', strtotime($customerPackage->dob)) }}">
                            </div>
                        </div>

                        {{-- Telephone --}}
                        <div class="mb-3 row">
                            <label for="tel" class="col-sm-4 text-center fs-4 col-form-label">ເບີໂທຕິດຕໍ່</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="country_code" id="country_code" value="{{substr($customerPackage->tel,0,4)}}">
                                <input type="text" required id="phone" onblur="onSelectCountry()"
                                    class="form-control form-control-lg {{ $errors->has('tel') ? 'border-danger' : '' }}"
                                    name="tel" value="{{ $customerPackage->tel }}">
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
                                    id="identity" name="identity" value="{{ $customerPackage->identity }}">
                            </div>
                        </div>
                        <hr>

                        {{-- Province --}}
                        <div class="mb-3 row">
                            <label for="province" class="col-sm-4 text-center fs-4 col-form-label">ແຂວງ</label>
                            <div class="col-sm-8">
                                <select name="province" id="province" required
                                    class="form-select form-select-lg {{ $errors->has('province') ? 'border-danger' : '' }}"
                                    onchange="onSelectInsuredProvince()" onfocus="this.selectedIndex = -1">
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $customerPackage->province == $item->id }}>
                                            {{ $item->province_name }}</option>
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
                            <label for="address" class="col-sm-4 text-center align-self-center fs-4 col-form-label ">ບ້ານ
                                ແລະ
                                ທີ່ຢູ</label>
                            <div class="col-sm-8 align-self-center">
                                <input type="text" required
                                    class="form-control form-control-lg {{ $errors->has('address') ? 'border-danger' : '' }}"
                                    id="address" name="address" value="{{ $customerPackage->address }}">
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
                                <select name="vehicleBrand" id="vehicleBrand" required
                                    class="form-select form-select-lg {{ $errors->has('vehicleBrand') ? 'border-danger' : '' }}">
                                    @foreach ($vehicleBrand as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $customerPackage->vehicle_brand == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
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
                                        <option value="{{ $item->id }}"
                                            {{ $customerPackage->plate_type == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
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
                                    id="number_plate" name="number_plate"
                                    value="{{ $customerPackage->number_plate }}">
                            </div>
                        </div>
                        {{-- Color --}}
                        <div class="mb-3 row">
                            <label for="color"
                                class="col-sm-4 text-center align-self-center fs-4 col-form-label">ສີ</label>
                            <div class="col-sm-8 align-self-center">
                                <input type="text" required
                                    class="form-control form-control-lg {{ $errors->has('color') ? 'border-danger' : '' }}"
                                    id="color" name="color" value="{{ $customerPackage->color }}">
                            </div>
                        </div>
                        {{-- Engine Number --}}
                        <div class="mb-3 row">
                            <label for="color"
                                class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກຈັກ</label>
                            <div class="col-sm-8 align-self-center">
                                <input type="text" required
                                    class="form-control form-control-lg {{ $errors->has('engine_number') ? 'border-danger' : '' }}"
                                    id="engine_number" name="engine_number"
                                    value="{{ $customerPackage->engine_number }}">
                            </div>
                        </div>

                        {{-- Chassic Number --}}
                        <div class="mb-3 row">
                            <label for="color"
                                class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກຖັງ</label>
                            <div class="col-sm-8 align-self-center">
                                <input type="text" required
                                    class="form-control form-control-lg {{ $errors->has('chassic_number') ? 'border-danger' : '' }}"
                                    id="chassic_number" name="chassic_number"
                                    value="{{ $customerPackage->chassic_number }}">
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
                                        <option value="{{ $item->id }}"
                                            {{ $customerPackage->registered_province == $item->id ? 'selected' : '' }}>
                                            {{ $item->province_name }}</option>
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
                                <img id="img_preview" src="{{ ImageServe::Base64($customerPackage->front_image) }}"
                                    class="border rounded img-fluid">
                            </div>
                        </div>


                        {{-- Term and Condition DialogBox --}}
                        <div class="modal fade" id="termModal" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="termModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="termModalLabel">ເງືອນໄຂ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $package->term }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-lg"
                                            data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> ອອກ</button>
                                        <button type="button" onclick="onFormSubmit()" class="btn btn-lg bg-blue text-white"><i class="bi bi-check-circle"></i> ຕົກລົງ</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Botton --}}
                        <div class="mb-3 row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="button" id="btnSubmit" data-bs-toggle="modal" data-bs-target="#termModal"
                                    class="btn bg-blue btn-lg text-white"><i class="bi bi-wallet-fill"></i>
                                    ຕົກລົງ</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection

@section('scripting')
    <script>
        var baseURL = "{{ env('BASE_ROUTE') }}";

        //When load page complete
        window.onload = function() {
            var provinceInsuredSelect = document.getElementById('province');
            provinceInsuredSelect.selectedIndex = 0;
            onSelectInsuredProvince();
        }

        //On Accept Box Change
        function onAcceptCheck() {
            var checkBox = document.getElementById('acceptBox');
            var btnSubmit = document.getElementById('btnSubmit');

            if (checkBox.checked) {
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = true;
            }
        }

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
                            if (data[i].id == {{ $customerPackage->district }}) {
                                option.setAttribute('selected', true);
                            }
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

        function onFormSubmit(){
            document.getElementById('formSubmit').submit();
        }
    </script>
@endsection
