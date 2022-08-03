@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="notosanLao text-center">ຢືນຢັນການຈ່າຍເງິນ</h3>
        </div>
    </div>
    {{-- Padding --}}
    <div class="pt-3"></div>
    {{-- Show Account and QR Code for scan --}}
    <div class=" bg-white">
        {{-- Account and QR --}}
        <div class="row">
            <div class="col-md-12 text-center pb-4">
                <h2 class="notosanLao">{{ $provider->name }}</h2>
                <div>
                    <span><img src="{{ asset($provider->logo) }}" class="provider-logo"></span>
                    <span class="notosanLao">ເລກບັນຊີ: <u>{{ $provider->account }}</u></span>
                </div>

                <img src="{{ asset($provider->qrscan) }}" class="QRScan pt-4">
            </div>

        </div>

        <div class="row">
            {{-- How to Pay --}}
            <div class="col-md-12 text-center">
                <h2 class="notosanLao text-center">ວິທີການຈ່າຍເງິນ</h2>
                <h5>&nbsp;</h5>

                <img src="{{ asset($provider->howto) }}" class="howto">
            </div>
        </div>
        {{-- Padding --}}
        <div class="pt-5"></div>
        {{-- Form Submit --}}
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="d-flex justify-content-center pt-2 mb-3">
                    <div class="card" style="width: 18.5rem;">
                        @if (!trim($company->logo))
                            <img src="{{ asset('assets/image/200x120.png') }}" class="rounded img-fluid me-2" alt="200x12"
                                srcset="" style="width: 300px; height: 200px;">
                        @else
                            <img src="{{ asset($company->logo) }}" alt="200x12" srcset=""
                                style="width: 300px; height: 200px;" class="rounded img-fluid me-2">
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
                <form action="{{ route('InsuranceFlowController.updatePaymentDetail') }}" enctype="multipart/form-data"
                    method="post" id="submitForm">
                    @csrf
                    <input type="file" name="slipUploaded" id="slipUploaded" hidden onchange="formSubmit()">
                    <div class="mb-3">
                        <label for="">ວັນ ແລະ ເວລາໂອນເງິນ</label>
                        <input type="datetime-local" name="transfer_time" id="transfer_time" class="form-control">
                    </div>
                    <div class="mb-3">

                        <input type="text" name="refer_no" id="refer_no" class="form-control"
                            placeholder="ເລກທີອ້າງອິງ(ສີ່ໂຕສຸດທ້າຍ)">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="transfer_amount" id="transfer_amount"
                            onkeypress="return onlyNumberKey(event)" onkeyup="formatNumber('transfer_amount')"
                            value="{{ number_format($saleOption->sale_price,0) }}" placeholder="ຈຳນວນເງິນທີ່ໂອນ"
                            class="form-control text-center fs-4 fw-bold">
                    </div>
                    <div class="mb-3 text-center">
                        <button onclick="onConfirmClick()" type="button" class="btn bg-blue text-white notosanLao btn-lg"><i
                                class="bi bi-check2-circle"></i> ອັບໂຫຼດຫຼັກຖານ ແລະ ຢຶນຢັນການຈ່າຍເງິນ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="pt-3"></div>
@endsection
@section('footer')
    <div class="">
        @include('layouts.footer')
    </div>
@endsection

@section('style')
    <style>
        .provider-logo {
            width: auto;
            height: 40px;
        }

        .provider-button {
            width: 100%;
        }

        .howto {
            width: auto;
            height: 500px;
        }

        .QRScan {
            width: auto;
            height: 500px;
        }
    </style>
@endsection
@section('scripting')
    @include('toastrMessage')
    <script>
        function onConfirmClick() {
            document.getElementById('slipUploaded').click();
        }

        //function to handle the file input
        function formSubmit() {
            if (document.getElementById('slipUploaded').files.length == 0) {
                console.log('no file selected');
            } else {
                console.log('file selected 1');
                document.getElementById('submitForm').submit();
            }
        }
    </script>
@endsection
