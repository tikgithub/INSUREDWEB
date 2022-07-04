@php
use App\Utils\ImageServe;
@endphp

@extends('layouts.admin_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="notosanLao text-center">
                ແກ້ໄຂຂໍ້ມູນປະກັນໄພ
            </h3>
        </div>
    </div>

    {{-- Body Data --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form autocomplete="off" method="POST" action="{{route('AdminInsuranceController.UpdateVehicleInsurance')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$inputData->id}}">
                <fieldset class="border notosanLao">
                    <legend class="bg-blue">- ຜູ້ເອົາປະກັນ</legend>
                    {{-- Padding Legend --}}
                    <div class="p-2">
                        {{-- Firstname --}}
                        <div class="mb-3 row">
                            <label for="firstname" class="col-sm-4 fs-4 text-center col-form-label">ຊື່</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-lg {{($errors->has('firstname')? 'border-danger':'')}}" id="firstname" name="firstname"
                                    value="{{$inputData->firstname}}">
                            </div>
                        </div>
                        {{-- Lastname --}}
                        <div class="mb-3 row">
                            <label for="lastname" class="col-sm-4 fs-4 text-center col-form-label">ນາມສະກຸນ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-lg {{($errors->has('lastname')? 'border-danger':'')}}" id="lastname" name="lastname"
                                    value="{{$inputData->lastname}}">
                            </div>
                        </div>

                        {{-- Sex --}}
                        <div class="mb-3 row">
                            <label for="sex" class="col-sm-4  fs-4 text-center col-form-label">ເພດ</label>
                            <div class="col-sm-8">
                                <select name="sex" id="sex" class="form-select form-select-lg {{($errors->has('sex')? 'border-danger':'')}}">
                                    <option value="M" {{($inputData->sex)=='M'? 'selected':''}}>ຊາຍ</option>
                                    <option value="F" {{($inputData->sex)=='F'? 'selected':''}} >ຍິງ</option>
                                </select>
                            </div>
                        </div>

                        {{-- DOB --}}
                        <div class="mb-3 row">
                            <label for="dob" class="col-sm-4 text-center fs-4 col-form-label">ວັນເກີດ</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control form-control-lg {{($errors->has('dob')? 'border-danger':'')}}" id="dob" name="dob"
                                    value="{{$inputData->dob}}">
                            </div>
                        </div>

                        {{-- Telephone --}}
                        <div class="mb-3 row">
                            <label for="tel" class="col-sm-4 text-center fs-4 col-form-label">ເບີໂທຕິດຕໍ່</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-lg {{($errors->has('tel')? 'border-danger':'')}}" id="tel" name="tel"
                                    value="{{$inputData->tel}}">
                            </div>
                        </div>

                        {{-- Password Or Identity ID --}}
                        <div class="mb-3 row">
                            <label for="identity"
                                class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກທີ່ບັດປະຊາຊົນ ຫຼື້
                                ເລກທີ Passport</label>
                            <div class="col-sm-8 align-self-center">
                                <input type="text" class="form-control form-control-lg {{($errors->has('identity')? 'border-danger':'')}}" id="identity" name="identity"
                                    value="{{$inputData->identity}}">
                            </div>
                        </div>
                        <hr>
                        {{-- Insured Address --}}
                        {{-- Province --}}
                        <div class="mb-3 row">
                            <label for="province" class="col-sm-4 text-center fs-4 col-form-label">ແຂວງ</label>
                            <div class="col-sm-8">
                                <select name="province" id="province" class="form-select form-select-lg {{($errors->has('province')? 'border-danger':'')}}"
                                    onchange="onSelectInsuredProvince()">
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}" {{($inputData->province)==$item->id? 'selected':''}} >{{ $item->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- District --}}
                        <div class="mb-3 row">
                            <label for="district" class="col-sm-4 text-center fs-4 col-form-label " >ເມືອງ</label>
                            <div class="col-sm-8">
                                <select name="district" id="district" class="form-select form-select-lg {{($errors->has('district')? 'border-danger':'')}}">
                                    @foreach ($districts as $item)
                                        <option value="{{$item->id}}" {{($inputData->district == $item->id)? 'selected':''}}>{{$item->district_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- Village Name --}}
                        <div class="mb-3 row">
                            <label for="address"
                                class="col-sm-4 text-center align-self-center fs-4 col-form-label ">ບ້ານ ແລະ
                                ທີ່ຢູ</label>
                            <div class="col-sm-8 align-self-center">
                                <input type="text" class="form-control form-control-lg {{($errors->has('address')? 'border-danger':'')}}" id="address" name="address"
                                    value="{{$inputData->address}}">
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
                                        <option value="{{$item->id}}" {{($inputData->vehicle_brand == $item->id)? 'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Select Plate type --}}
                        <div class="mb-3 row">
                            <label for="plate"
                                class="col-sm-4 text-center align-self-center fs-4 col-form-label">ປະເພດປ້າຍ</label>
                            <div class="col-sm-8 align-self-center">
                               <select name="plateType" id="plateType" class="form-select form-select-lg {{ $errors->has('plateType') ? 'border-danger' : '' }}">
                                    @foreach ($licenses as $item)
                                        <option value="{{$item->id}}" {{($inputData->plate_type == $item->id? 'selected':'')}}>{{$item->name}}</option>
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
                                    name="number_plate" value="{{$inputData->number_plate}}">
                            </div>
                        </div>
                        {{-- Color --}}
                        <div class="mb-3 row">
                            <label for="color"
                                class="col-sm-4 text-center align-self-center fs-4 col-form-label">ສີ</label>
                            <div class="col-sm-8 align-self-center">
                                <input type="text" class="form-control form-control-lg {{($errors->has('color')? 'border-danger':'')}}" id="color" name="color"
                                    value="{{$inputData->color}}">
                            </div>
                        </div>
                        {{-- Province Registered --}}
                        <div class="mb-3 row">
                            <label for="registeredProvince"
                                class="col-sm-4 text-center fs-4 col-form-label">ແຂວງທີ່ຂຶ້ນທະບຽນ</label>
                            <div class="col-sm-8">
                                <select name="registeredProvince" id="registeredProvince"
                                    class="form-select form-select-lg {{($errors->has('registeredProvince')? 'border-danger':'')}}">
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}" {{($inputData->registeredProvince == $item->id)? 'selected':''}}>{{ $item->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Engine Number --}}
                        <div class="mb-3 row">
                            <label for="color"
                                class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກຈັກ</label>
                            <div class="col-sm-8 align-self-center">
                                <input type="text" class="form-control form-control-lg {{($errors->has('engine_number')? 'border-danger':'')}}" id="engine_number" name="engine_number"
                                    value="{{ $inputData->engine_number}}">
                            </div>
                        </div>

                        {{-- Chassic Number --}}
                        <div class="mb-3 row">
                            <label for="color"
                                class="col-sm-4 text-center align-self-center fs-4 col-form-label">ເລກຖັງ</label>
                            <div class="col-sm-8 align-self-center">
                                <input type="text" class="form-control form-control-lg {{($errors->has('chassic_number')? 'border-danger':'')}}" id="chassic_number" name="chassic_number"
                                    value="{{$inputData->chassic_number}}">
                            </div>
                        </div>

                        <h4 class="notosanLao text-center">
                            ຮູບພາບ
                        </h4>
                        <hr>
                        {{-- Car Side Front Image --}}
                        <div class="mb-3 row">
                            <div class="col-sm-6 text-center">
                                <img class="ms-2" src="{{ImageServe::Base64($inputData->front_image)}}" style="width: auto; height: 100px;" alt="" srcset="">
                            </div>
                            <div class="col-sm-6 align-self-center">
                                <input type="file" name="front" id="front" class="form-control-file border {{($errors->has('front')? 'border-danger':'')}}" style="width: 100%">
                            </div>
                        </div>

                         {{-- Car Side left Image --}}
                         <div class="mb-3 row">
                            <div class="col-sm-6 text-center">
                                <img class="ms-2" src="{{ImageServe::Base64($inputData->left_image)}}" style="width: auto; height: 100px;" alt="" srcset="">
                            </div>
                            <div class="col-sm-6 align-self-center">
                                <input type="file" name="left" id="left" class="form-control-file border {{($errors->has('left')? 'border-danger':'')}}" style="width: 100%">
                            </div>

                        </div>

                         {{-- Car Side right Image --}}
                         <div class="mb-3 row">
                            <div class="col-sm-6 text-center">
                                <img class="ms-2" src="{{ImageServe::Base64($inputData->right_image)}}" style="width: auto; height: 100px;" alt="" srcset="">
                            </div>
                            <div class="col-sm-6 align-self-center">
                                <input type="file" name="right" id="right" class="form-control-file border {{($errors->has('right')? 'border-danger':'')}}" style="width: 100%">
                            </div>
                        </div>

                         {{-- Car Side rear Image --}}
                         <div class="mb-3 row">
                            <div class="col-sm-6 text-center">
                                <img class="ms-2" src="{{ImageServe::Base64($inputData->rear_image)}}" style="width: auto; height: 100px;" alt="" srcset="">
                            </div>
                            <div class="col-sm-6 align-self-center">
                                <input type="file" name="rear" id="rear" class="form-control-file border {{($errors->has('rear')? 'border-danger':'')}}" style="width: 100%">
                            </div>
                        </div>

                        {{-- Car Book Image --}}
                        <div class="mb-3 row">
                            <div class="col-sm-6 text-center">

                                <img class="ms-2 rounded" src="{{ImageServe::Base64($inputData->yellow_book_image)}}" style="width: auto; height: 100px;" alt="" srcset="">
                            </div>
                            <div class="col-sm-6 align-self-center">
                                <input type="file" name="yellow_book" id="yellow_book" class="form-control-file border {{($errors->has('yellow_book')? 'border-danger':'')}}" style="width: 100%">
                            </div>
                        </div>
                        <hr>

                         {{-- Acception Check Box --}}
                         <div class="mb-3 row">
                            <div class="col-md-12">
                                <div class="form-check notosanLao">
                                    <input class="form-check-input ms-3" type="checkbox" value="" id="acceptCheckbox" onchange="onClickAccepted()">
                                    <label class="form-check-label ms-2 fs-5" for="acceptCheckbox">
                                      ໄດ້ຮັບຄວາມຍິນຍອມຈາກລູກຄ້າແລ້ວ ເພື່ອປ່ຽນແປງຂໍ້ມູນ
                                    </label>
                                  </div>
                            </div>
                        </div>

                        {{-- Submit Botton --}}
                        <div class="mb-3 row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button id="btnSubmit" type="submit" class=" btn-lg btn bg-blue text-white" disabled>ແກ້ໄຂ</button>
                            </div>
                        </div>
                    </div>

                </fieldset>

            </form>
        </div>

    </div>

@endsection
@section('footer')
<div class="">
    @include('layouts.footer')
</div>
@endsection
@section('scripting')
@include('toastrMessage')
    <script>
        var baseURL = "{{ env('BASE_ROUTE') }}";
        //Function on select the accepts term and condition
        function onClickAccepted(){
            var acceptCheckBox = document.getElementById('acceptCheckbox');
            var btnSubmit = document.getElementById('btnSubmit');
            //Check the checkbox is checked ???
            if(acceptCheckBox.checked){
                //Checked
                btnSubmit.disabled = false;
            }else{
                //Un-Checked
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

         /* If browser back button was used, flush cache */
         (function() {
            window.onpageshow = function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
            };
        })();
    </script>
@endsection
