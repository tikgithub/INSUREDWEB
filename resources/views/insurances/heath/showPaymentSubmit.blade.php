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
        <div class="row">
            <div class="col-md-8 offset-md-2">
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
                                <td class="fs-5">{{ $item->name }}</td>
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
        </div>
        {{-- Form Submit --}}
        <div class="row">
            <div class="col-md-4 offset-md-4 text-center">
                <form action="{{route('HeathSaleController.SubmitHeathPayment')}}" enctype="multipart/form-data" method="post" id="submitForm">
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
                        <input type="text" onkeypress="return onlyNumberKey(event)" onkeyup="formatNumber('transfer_amount')" name="transfer_amount"
                            id="transfer_amount"  value="{{ number_format($plan->sale_price, 0) }}"
                            placeholder="ຈຳນວນເງິນທີ່ໂອນ" class="form-control text-center fs-4 fw-bold">
                    </div>
                    <button onclick="onConfirmClick()" type="button" class="btn bg-blue text-white notosanLao btn-lg"><i class="bi bi-check2-circle"></i> ຢຶນຢັນການຈ່າຍເງິນ</button>
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
