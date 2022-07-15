@php
use App\Utils\ImageCompress;
use App\Utils\ImageServe;
@endphp
@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>

    {{-- Header Title --}}
    <div class="row mb-2">

        <div class="notosanLao col-md-12 text-center">
            <img src="{{ asset($planDatas->logo) }}" class="rounded mb-2" style="width: auto;height: 70px;">
            <h2>ຢືນຢັນ ແລະ ກວດສອບຂໍ້ມູນລາຍລະອຽດຂອງປະພັນໄພ</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>
                {{ $planDatas->companyName }} {{ $planDatas->coverType }} - <b>{{ $planDatas->planName }}</b>
            </h3>

        </div>
    </div>

    {{-- End Header Title --}}
    <hr>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4 text-center">
            <h4 class=" mb-4"><u>ລາຍການທີ່ຄຸ້ມຄອງ</u></h4>
            <h5>
                ເງືອນໄຂອາຍຸລະວ່າງ: {{ $plan->start_age }} - {{ $plan->end_age }}
            </h5>
        </div>
    </div>
    <div class="row mb-2 pt-3">
        <div class="col-md-2"></div>

        <div class="col-md-4">
            <table class="table table-hover table-bordered">
                <thead class="bg-blue text-white fs-4">
                    <th>#</th>
                    <th>ລາຍການຄຸ້ມຄອງ</th>
                    <th class="text-end">ວົງເງິນຄຸ້ມຄອງ</th>
                </thead>
                <tbody>
                    @foreach ($coverData as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="fs-5">{{ $item->item }}</td>
                            <td class="text-end fs-5">{{ number_format($item->cover_price, 0) }} ກີບ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="fs-4 fw-bold">
                            ລວມຄ່າທຳນຽມຕໍ່ປີ
                        </td>
                        <td class="text-end fs-4 fw-bold">
                            {{ number_format($plan->sale_price, 0) }} ກີບ
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-6">
            {{-- Check Customer Authentication --}}
            @if (Auth::check())
                {{-- Show Input form --}}
                <div class="card">
                    <div class="card-header bg-blue">
                        <h5 class="text-white"> - ຢືນຢັນຂໍ້ມູນອີກຄັ້ງ</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('AccidentSaleController.updateConfirmation') }}" method="POST" id="updateForm"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{$plan->id}}">
                            <input type="hidden" name="update_id" value="{{$accidentData->id}}">
                            <div class="row mb-3">
                                <label for="firstname" class="col-sm-3 col-form-label fs-4">ຊື່<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="firstname" id="firstname"
                                        class=" form-control form-control-lg" value="{{$accidentData->firstname}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="lastname" class="col-sm-3 col-form-label fs-4">ນາມສະກຸນ<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="lastname" id="lastname" class=" form-control form-control-lg"
                                    value="{{$accidentData->lastname}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sex" class="col-sm-3 col-form-label fs-4">ເພດ<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9">
                                    <select name="sex" id="sex" class="form-select form-select-lg">
                                        <option>ເລືອກ</option>
                                        <option value="M" {{$accidentData->sex == "M" ? 'selected':''}}>ຊາຍ</option>ງ
                                        <option value="F" {{$accidentData->sex == "F" ? 'selected':''}}>ຍິງ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 fs-4">
                                <label for="dob" class="col-sm-3 col-form-label">ວັນເດືອນປິເກີດ<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9">
                                    <div id="dtBox"></div>
                                    <input readonly type="text" data-field="date" name="dob" id="dob" class="form-control form-control-lg" value="{{ date('d-m-Y', strtotime($accidentData->dob)) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tel" class=" fs-4 col-form-label col-sm-3">ເບີໂທຕິດຕໍ່<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="country_code" name="country_code">
                                    <input type="tel" onblur="onSelectCountry()" name="tel" id="phone" class="form-control form-control-lg"
                                        value="{{$accidentData->tel}}">
                                </div>
                            </div>

                            <div class="row mb-3 fs-4">
                                <label for="identity" class="col-form-label col-sm-3">ເລກທີ່ບັດປະຊາຊົນ ຫຼື
                                    ໜັງສືຜ່ານແດນ<span class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9 align-self-center">
                                    <input type="text" name="identity" id="identity" class="form-control form-control-lg"
                                    value="{{$accidentData->identity}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3 fs-4">
                                <label for="province" class="col-form-label col-sm-3">ແຂວງ<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9">
                                    <select name="province" id="province" class="form-select form-select-lg"
                                        onchange="onSelectedProvince()">
                                        <option>ເລືອກ</option>
                                        @foreach ($provinceData as $item)
                                            <option value="{{ $item->id }}" {{$accidentData->province == $item->id ? 'selected':''}}>{{ $item->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 fs-4">
                                <label for="district" class="col-form-label col-sm-3">ເມືອງ<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9">
                                    <select name="district" id="district" class="form-select form-select-lg">
                                        <option>ເລືອກ</option>
                                        @foreach ($districtData as $item)
                                            <option value="{{$item->id}}" {{$item->id == $accidentData->district? 'selected':''}}>{{$item->district_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 fs-4">
                                <label for="address" class="col-form-label col-sm-3">ບ້ານ<span
                                        class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9">
                                    <textarea name="address" id="address" rows="5" class="form-control">{{$accidentData->address}}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3 fs-4">
                                <label for="district" class="col-form-label col-sm-3 align-self-center">ຮູບຖ່າຍບັດປະຈຳໂຕ ຫຼື
                                    ໜັງສືຜ່ານແດນ<span class="text-danger fs-6">*</span></label>
                                <div class="col-sm-9 align-self-center text-center">
                                    <input type="file" name="reference_photo" id="reference_photo" class="form-control-file"
                                        hidden onchange="onPreviewChange()">
                                    <button type="button" onclick="selectPhotoOnClick()"
                                        class="btn btn-warning btn-lg mb-2"><i class="bi bi-image-alt"></i>
                                        ເລືອກຮູບ</button><br>
                                    <img id="img_preview" src="{{ImageServe::Base64($accidentData->front_image)}}" alt="" srcset="" class="border rounded img-fluid">
                                </div>
                            </div>

                            <hr>
                            <div class="mb-3 fs-4 text-center">
                                <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button" class="btn btn-lg bg-blue text-white"><i class="bi bi-cash me-3"></i>ຈ່າຍເງິນ</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                {{-- Show Login form --}}
                <h4 class="text-center">ທ່ານຍັງບໍ່ໄດ້ເຂົ້າສູ່ລະບົບ</h4>
                {{-- Login Session --}}
                <form action="{{ route('UserController.validateUserBeforeBuying') }}" method="post"
                    class="notosanLao shadow pt-4 p-3 mx-auto text-center">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                        <input type="email"
                            class="form-control form-control-lg text-center {{ $errors->has('email') ? 'border-danger' : '' }}"
                            placeholder="ອີເມວ" aria-label="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-asterisk"></i></span>
                        <input type="password"
                            class="form-control form-control-lg text-center {{ $errors->has('password') ? 'border-danger' : '' }}"
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

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">ເງືອນໄຂຂອງປະກັນໄພ</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea name="" id="" cols="30" rows="10" class="form-control">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde molestiae labore sapiente quam, iusto voluptas. Dolore ea consequatur sapiente autem culpa, rerum dolor ut voluptas quisquam quibusdam corrupti magnam odit.
                </textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">ອອກ</button>
              <button type="submit" form="updateForm" class="btn btn-primary btn-lg">ຕົກລົງ</button>
            </div>
          </div>
        </div>
      </div>


@endsection
@section('footer')
    @include('layouts.footer')
@endsection
@section('scripting')
    @include('toastrMessage')
    <script>
        //When page load completed
        window.onload = function(){
            onSelectCountry();
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

        function onSelectedProvince() {
            var std_Province = document.getElementById('province');
            var selectedProvinceId = std_Province.options[std_Province.selectedIndex].value;
            var std_district = document.getElementById('district');
            //clear option element
            std_district.innerHTML = "";
            var url = "{{ route('JSONDistrict', '') }}/" + selectedProvinceId;

            fetch(url).then(res => res.json()).then(data => {
                for (i = 0; i < data.length; i++) {
                    var option = document.createElement('option');
                    option.value = data[i].id;
                    option.text = data[i].district_name;
                    std_district.append(option);
                }
            }).catch(error => {
                console.log(error);
            });
        }

        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: "la",
            utilsScript: "{{asset('assets/telinput/js/utils.js')}}",

        });

        function onSelectCountry() {
            document.getElementById("country_code").value = "+" + iti.getSelectedCountryData().dialCode;
        }

    </script>
@endsection
