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
            <form autocomplete="off" method="POST" action="{{route('AdminInsuranceController.UpdateHeathInsurance')}}" enctype="multipart/form-data">
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
                        <h4 class="notosanLao text-center">
                            ຮູບພາບ
                        </h4>
              
                        {{-- Car Side Front Image --}}
                        <div class="mb-3 row">
                            <div class="col-sm-6 text-center">
                               
                                <img class="ms-2" src="{{ImageServe::Base64($inputData->front_image)}}" style="width: auto; height: 100px;" alt="" srcset="">
                            </div>
                            <div class="col-sm-6 align-self-center">
                                <input type="file" name="front" id="front" class="form-control-file border {{($errors->has('front')? 'border-danger':'')}}" style="width: 100%">
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
                                <button id="btnSubmit" type="submit" class=" btn-lg btn bg-blue text-white" disabled><i class="bi bi-cash-stack"></i> ຊຳລະເງິນ</button>
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
