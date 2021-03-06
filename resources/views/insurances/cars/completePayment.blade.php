@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h1 class="notosanLao text-center">ດຳເນີນການສຳເລັດ</h1>
            <p class="fs-4 notosanLao text-center">
                ທີມງານຈະຕິດຕໍ່ພາຍຫຼັງ ຫຼັງຈາກກວດສອບສຳເລັດ
            </p>
            <div class="text-center pt-5 pb-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="#36ba59"
                    class="bi bi-check2-circle" viewBox="0 0 16 16">
                    <path
                        d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                    <path
                        d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                </svg>
            </div>
            <div class="text-center">
                <a href="{{ route('UserController.showUserInsuranceList') }}" class="btn bg-blue btn-lg text-white notosanLao">
                    ລາຍການຊື້ປະກັນໄພ</a>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection

@section('styles')
@endsection

@section('scripting')
@endsection
