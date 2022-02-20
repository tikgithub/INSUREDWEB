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
    <div class=" bg-white p-5 shadow">
        {{-- Account and QR --}}
        <div class="row">
            <div class="col-md-12 text-center pb-4">
                <h2 class="notosanLao">{{ $provider->name }}</h2>
                <div>
                    <span><img src="{{ asset($provider->logo) }}" class="provider-logo"></span>
                    <span class="notosanLao">ເລກບັນຊີ: <u>{{ $provider->account }}</u></span>
                </div>

                <img src="{{ asset($provider->qrscan) }}" class="shadow img-fluid pt-4">
            </div>

        </div>

        <div class="row">
            {{-- How to Pay --}}
            <div class="col-md-12">
                <h2 class="notosanLao text-center">ວິທີການຈ່າຍເງິນ</h2>
                <h5>&nbsp;</h5>

                <img src="{{ asset($provider->howto) }}" class="img-fluid">
            </div>
        </div>
        {{-- Padding --}}
        <div class="pt-5"></div>
        {{-- Form Submit --}}
        <div class="row">
            <div class="col-md-12 text-center">
                <form action="{{route('InsuranceFlowController.updatePaymentDetail')}}" enctype="multipart/form-data" method="post" id="submitForm">
                    @csrf
                    <input type="file" name="slipUploaded" id="slipUploaded" hidden onchange="formSubmit()">
                    <button onclick="onConfirmClick()" type="button" class="btn bg-blue text-white notosanLao btn-lg"><i class="bi bi-check2-circle"></i> ຢຶນຢັນການຈ່າຍເງິນ</button>
                </form>
            </div>
        </div>
    </div>
    <div class="pt-3"></div>

    <div class="fixed-bottom">
        @include('layouts.footer')
    </div>
@endsection
@section('styles')
    <style>
        .provider-logo {
            width: auto;
            height: 40px;
        }

        .provider-button {
            width: 100%;
        }

    </style>
@endsection
@section('scripting')
    <script>
        function onConfirmClick(){
            document.getElementById('slipUploaded').click();
        }

        //function to handle the file input
        function formSubmit(){
            if(document.getElementById('slipUploaded').files.length == 0){
                console.log('no file selected');
            }else{
                console.log('file selected 1');
                document.getElementById('submitForm').submit();
            }
        }
    </script>
@endsection