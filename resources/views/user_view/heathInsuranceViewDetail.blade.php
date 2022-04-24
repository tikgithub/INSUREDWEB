@php
use App\Utils\ImageCompress;
@endphp
@extends('layouts.public_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 fw-bold fs-3">
            ລາຍລະອຽດຂອງປະກັນໄພ
        </div>
        <hr>
    </div>
    <div class="pt-3"></div>
    {{-- ImageCompress::getThumnailImage(asset($insurance->front_image)) --}}
    <div class="row">
        <div class="col-md-2 text-center">
            @isset($insurance->front_image)
                <img src="{{ ImageCompress::getThumnailImage($insurance->front_image) }}" id="front_image"
                    class="thumbnail-image mb-3 border border-dark" img-data="{{ asset($insurance->front_image) }}"
                    onclick="onClickThumnailImage('front_image')">
            @endisset
        </div>
        <div class="col-md-6">
            <img src="{{ asset($insurance->front_image) }}" alt="" srcset="" class="img-fluid rounded shadow"
                id="preview_image">
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <img src="{{ asset($heathInsurance->company_logo) }}" class="shadow company-logo mb-2">
                <h2><b>{{ $heathInsurance->company_name }}</b></h2>

            </div>
            <div class="text-center">
                <h5>{{ $heathInsurance->package_name }} {{ $heathInsurance->plan_name }}
                </h5><br>
                <h6>ຄ່າທຳນຽມ: <u>{{ number_format($insurance->fee_charge, 0) }}</u></h6>
                <h2>ລວມ: <b class="text-danger">{{ number_format($insurance->total_price, 0) }} ກີບ/ຕໍ່ປີ</b></h2>
            </div>
            <div class="mb-3 border" style="width: 25rem">
                <table class="table table-sm table-hover bg-white">
                    <thead class="text-white bg-blue">
                        <th>ລາຍການ</th>
                        <th class="text-end">ວົງເງິນຄຸ້ມຄອງ</th>
                    </thead>
                    <tbody>
                        @foreach ($coverDetail as $item)
                            <tr>
                                <th>{{ $item->name }}</th>
                                <th class="text-end">{{ number_format($item->cover_price, 0) }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr>
    <h3 class="fw-bold">ຂໍ້ມູນຜູ້ເອົາປະກັນໄພ</h3>
    <div class="row" style="line-height: 20px;">
        <div class="col-md-12">
            <div class="form mt-3 fs-5">
                <div class="row mb-3">
                    <label for="" class="col-sm-2 fw-bold">ຊື່ ແລະ ນາມສະກຸນ</label>
                    <div class="col-sm-10">
                        {{ $insurance->sex == 'M' ? 'ທ' : 'ນ' }}. {{ $insurance->firstname }}
                        {{ $insurance->lastname }}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 fw-bold">ວັນເດືອນປີເກີດ</label>
                    <div class="col-sm-10">
                        {{ \Carbon\Carbon::parse($insurance->dob)->format('d/m/Y') }}
                        ({{ explode(' ', \Carbon\Carbon::parse($insurance->dob)->diffForHumans(null, true))[0] }} ປີ)
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 fw-bold">ເບີໂທຕິດຕໍ່</label>
                    <div class="col-sm-10">
                        <u>{{ $insurance->tel }}</u>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 fw-bold">ເລກທີ່ບັດປະຊາຊົນ ຫຼື ໜັງສືຜ່ານແດນ</label>
                    <div class="col-sm-10">
                        {{ $insurance->identity }}
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="col-sm-2 fw-bold">ທີ່ຢູ່</label>
                    <div class="col-sm-10">
                        {{ \App\Models\Province::find($insurance->province)->province_name }},
                        {{ \App\Models\District::find($insurance->district)->district_name }},
                        {{ $insurance->address }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <h3 class="fw-bold">ສະຖານະຂອງປະກັນ</h3>
    @switch($insurance->payment_confirm)
        @case('WAIT_FOR_PAYMENT')
            <div class="alert text-center fs-4 fw-bold alert-info me-2" role="alert">
                <i class="bi bi-cash-stack me-2"></i> ກາລຸນາຢືນຢັນການສັ່ງຊື້
                <a href="{{ route('UserController.SetVehicleInsuranceID', ['id' => $insurance->id]) }}"
                    class="btn btn-success ms-2 btn-lg"><i class="bi bi-cash me-2"></i>ຈ່າຍເງິນ</a>
            </div>
        @break

        @case('WAIT_FOR_APPROVED')
            <div class="alert fs-4 fw-bold alert-warning me-2" role="alert">
                <i class="bi bi-clock-history me-2"></i> ກາລຸນາລໍຖ້າລາຍກຳລັງຢູ່ໃນການກວດສອບ
            </div>
        @break

        @case('APPROVED_OK')
            <div class=" fs-4 fw-bold me-2 text-center" role="">
                <a href="" class="btn btn-success"><i class="bi bi-book me-2"></i> ເບິ່ງສັນຍາ</a>
            </div>
        @break
    @endswitch
@endsection
@section('scripting')
    <script>
        function onClickThumnailImage(id) {
            var sourceImage = document.getElementById(id);
            var targetImage = document.getElementById('preview_image');
            targetImage.src = sourceImage.getAttribute('img-data');
        }
    </script>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection

@section('style')
    <style>
        .company-logo {
            width: 100px;
            height: 100px;
            border-radius: 50px;
            object-fit: cover;
        }

        .thumbnail-image {
            width: auto;
            height: 80px;
            object-fit: cover;
        }

        .thumbnail-image:hover {
            cursor: pointer;
            padding: 2px;
            background-color: grey;
        }

    </style>
@endsection
