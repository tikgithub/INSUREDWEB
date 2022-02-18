@extends('layouts.public_layout')
@section('content')
    {{-- Header --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 notosanLao">
            <h3 class="notosanLao text-center">
                ເລືອກປະເພດປະກັນໄພ
            </h3>
        </div>
    </div>
    <div class="pt-5"></div>
    {{-- Card data --}}
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            <div class="card shadow notosanLao pt-2" style="width: 19.8rem">
                <div class="card-body text-center">
                    <a href="{{route('InsuranceFlowController.showCarInsuranceSelectionMenu')}}">
                        <img src="{{ asset('assets/image/car_accident.png') }}" style="width: auto;height: 200px;">
                        <h3>
                            ປະກັນໄພລົດ
                        </h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <div class="card shadow notosanLao pt-2" style="width: 19.8rem">
                <div class="card-body text-center">
                    <a href="http://">
                        <img src="{{ asset('assets/image/heath.png') }}" style="width: auto;height: 200px;">
                        <h3>
                            ປະກັນໄພບຸກຄົນ
                        </h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
        @include('layouts.footer')
    </div>
@endsection
