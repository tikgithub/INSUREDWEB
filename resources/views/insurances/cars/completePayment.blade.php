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
            <div class="wrapper"> <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>
            </div>
            <div class="text-center">
                <a href="{{route('UserController.userListInsurance')}}" class="btn bg-blue btn-lg text-white notosanLao"> ລາຍການຊື້ປະກັນໄພ</a>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .checkmark__circle {
            stroke-dasharray: 200;
            stroke-dashoffset: 200;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #7ac142;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards
        }

        .checkmark {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin: 10% auto;
            box-shadow: inset 0px 0px 0px #7ac142;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none
            }

            50% {
                transform: scale3d(1.1, 1.1, 1)
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 50px #7ac142
            }
        }

    </style>
@endsection
@section('scripting')
    <script>
    </script>
@endsection
