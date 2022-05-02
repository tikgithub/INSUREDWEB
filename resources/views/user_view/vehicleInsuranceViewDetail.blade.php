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

            @isset($insurance->left_image)
                <img src="{{ ImageCompress::getThumnailImage($insurance->left_image) }}" id="left_image"
                    class="thumbnail-image mb-3 border border-dark" img-data="{{ asset($insurance->left_image) }}"
                    onclick="onClickThumnailImage('left_image')">
            @endisset

            @isset($insurance->right_image)
                <img src="{{ ImageCompress::getThumnailImage($insurance->right_image) }}" id="right_image"
                    class="thumbnail-image mb-3 border border-dark" img-data="{{ asset($insurance->right_image) }}"
                    onclick="onClickThumnailImage('right_image')">
            @endisset

            @isset($insurance->rear_image)
                <img src="{{ ImageCompress::getThumnailImage($insurance->rear_image) }} " id="rear_image"
                    class="thumbnail-image mb-3 border border-dark" img-data="{{ asset($insurance->rear_image) }}"
                    onclick="onClickThumnailImage('rear_image')">
            @endisset

            @isset($insurance->yellow_book_image)
                <img src="{{ ImageCompress::getThumnailImage($insurance->yellow_book_image) }}" id="yellow_book_image"
                    class="thumbnail-image mb-3 border border-dark" img-data="{{ asset($insurance->yellow_book_image) }}"
                    onclick="onClickThumnailImage('yellow_book_image')">
            @endisset

        </div>
        <div class="col-md-6">
           
            <img src="{{ asset($insurance->front_image) }}" class=" rounded shadow"
                id="preview_image">
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <img src="{{ asset($insuranceDetail->company_logo) }}" class="shadow company-logo mb-2">
                <h2><b>{{ $insuranceDetail->company_name }}</b></h2>

            </div>
            <div class="text-center">
                <h5>{{ $insuranceDetail->level_name }} {{ $insuranceDetail->package_name }}
                    {{ $insuranceDetail->option_name }} </h5><br>
                <h6>ຄ່າທຳນຽມ: <u>{{ number_format($insurance->fee_charge, 0) }}</u></h6>
                <h2>ລວມ: <b class="text-danger">{{ number_format($insurance->total_price, 0) }} ກີບ/ຕໍ່ປີ</b></h2>
            </div>
            <div class="row pt-3">
                <div class="col-md-12">
                    <div class="d-grid gap-1">
                        <button class="btn btn-block bg-blue text-white notosanLao" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            ລາຍລະອຽດການຄຸ້ມຄອງ
                        </button>
                    </div>
                    <div class="collapse" id="collapseExample">
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
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><u>ຫຼັກຖານການຈ່າຍເງິນ</u></h3>
                    <img class="img-fluid" src="{{$insurance->slipUploaded}}" alt="" srcset="">
                </div>
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
        #preview_image{
            width: 100%;
            height: auto;
        }

    </style>
@endsection
