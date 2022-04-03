@extends('layouts.public_layout')
@section('content')
    {{-- Header --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 notosanLao">
            <h1 class="notosanLao text-center">
                ເລືອກຮູບແບບປະກັນໄພ
            </h1>
        </div>
    </div>
    <div class="pt-5"></div>
    {{-- Card data --}}
    <div class="row" style="padding-bottom: 150px;">
        <div class="col-md-4 d-flex justify-content-center pt-2 zoom">
            <div class="card shadow notosanLao pt-2" style="width: 19.8rem">
                <div class="card-body text-center">
                    <a href="{{route('InsuranceFlowController.showCarInsuranceSelectionMenu')}}" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/image/car_accident.png') }}" style="width: auto;height: 200px;">
                        <h4 class="mt-2">
                            ປະກັນໄພລົດ
                        </h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center pt-2">
            <div class="card shadow notosanLao pt-2 zoom" style="width: 19.8rem">
                <div class="card-body text-center">
                    <a href="{{route('AccidentSaleController.showSelectCompany')}}" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/image/personal_accident.png') }}" style="width: auto;height: 200px;">
                        <h4 class="mt-2">
                            ປະກັນໄພອຸບັດຕິເຫດບຸກຄົນ PA/OPA
                        </h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center pt-2">
            <div class="card shadow notosanLao pt-2 zoom" style="width: 19.8rem">
                <div class="card-body text-center">
                    <a href="http://" class="text-decoration-none text-dark">
                        <img src="{{ asset('assets/image/heath.png') }}" style="width: auto;height: 200px;">
                        
                        <h4 class="mt-2">
                            ປະກັນໄພສຸຂະພາບ
                        </h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('footer')
<div class="">
    @include('layouts.footer')
</div>
@endsection