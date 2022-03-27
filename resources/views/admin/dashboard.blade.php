@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>

    <div class="row notosanLao">
        <div class="col-md-12">
            <h3 class="text-center">ລາຍການປະກັນໄພຍານພາຫະນະ</h3>
        </div>
    </div>
    <hr>
    {{-- Card Menu --}}
    <div class="row notosanLao">
        {{-- Insurance Item is waiting for payment from customer --}}
        <div class="col-md-3">
            <div class="card border-secondary mb-3">
                <div class="card-header bg-secondary border-secondary text-white text-center fs-4"> <i class="bi bi-send-plus-fill me-2"></i> ລາຍການລໍຖ້າການຊຳລະເງິນ</div>
                <div class="card-body text-success text-center" >
                    <a type="button" href="{{route('AdminController.showAllCustomerInput')}}" class="btn btn-light border mb-2" style="width: 100%">
                        ລາຍການທັງໝົດ <span class="ms-2 badge bg-danger">{{sizeof($newPurchase)}}</span>
                    </a>
                    {{-- <ul class="list-group">
                        @foreach ($newPurchase as $item)
                            <li class="list-group-item">ເລກທະບຽນລົດ: <a href="{{route('AdminController.showCustomerInput',['id'=>$item->id])}}">{{$item->number_plate}}</a></li>
                        @endforeach
                      </ul> --}}
                </div>
            </div>
        </div>
        {{-- Insurance Payment Already Wait for approve --}}
        <div class="col-md-3">
            <div class="card border-success mb-3" >
                <div class="card-header bg-success border-success text-white text-center fs-4"><i class="bi bi-cash-coin me-2"></i> ລາຍການລໍຖ້າອານຸມັດ</div>
                <div class="card-body text-success text-center" >
                    <a href="{{route('AdminController.showAllPaymentItem')}}"  class="btn btn-light border mb-2" style="width: 100%">
                        ລາຍການທັງໝົດ <span class="ms-2 badge bg-danger">{{sizeof($paymentItems)}}</span>
                    </a>
                    {{-- <ul class="list-group">
                        @foreach ($paymentItems as $item)
                            <li class="list-group-item">ເລກທະບຽນລົດ: <a class="" href="{{route('AdminController.showCustomerPaymentItem',['id'=>$item->id])}}">{{$item->number_plate}}</a></li>
                        @endforeach
                      </ul> --}}
                </div>
            </div>
        </div>
        {{-- Insurance In Contract --}}
        <div class="col-md-3">
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary border-primary text-white text-center fs-4"><i class="bi bi-body-text me-2"></i> ລາຍການຢູ່ໃນສັນຍາ</div>
                <div class="card-body text-success text-center" >
                    <a href="{{route('AdminController.showAllApprovedItem')}}" class="btn btn-light border mb-2" style="width: 100%">
                        ລາຍການທັງໝົດ <span class="ms-2 badge bg-danger">{{sizeof($contracts)}}</span>
                    </a>
                    {{-- <ul class="list-group">
                        @foreach ($contracts as $item)
                            <li class="list-group-item">ເລກທະບຽນລົດ: <a class="" href="{{route('AdminController.showInsuranceInContract',['id'=>$item->id])}}">{{$item->number_plate}}</a></li>
                        @endforeach
                      </ul> --}}
                </div>
            </div>
        </div>

         {{-- Insurance Out Of Contract --}}
         <div class="col-md-3">
            <div class="card border-danger mb-3">
                <div class="card-header bg-danger border-danger text-white text-center fs-4"><i class="bi bi-exclamation-diamond-fill me-2"></i> ລາຍການທີ່ໝົດສັນຍາພາຍໃນ 14 ວັນ</div>
                <div class="card-body text-success text-center" >
                    <a href="{{route('AdminController.showAllOutOfContract')}}" class="btn btn-light border mb-2" style="width: 100%">
                        ລາຍການທັງໝົດ <span class="ms-2 badge bg-danger">{{sizeof($outOfContracts)}}</span>
                    </a>
                    {{-- <ul class="list-group">
                        @foreach ($outOfContracts as $item)
                            <li class="list-group-item">ເລກທະບຽນລົດ: <a class="" href="{{route('AdminController.viewOutOfContract',['id'=>$item->id])}}">{{$item->number_plate}}</a></li>
                        @endforeach
                      </ul> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Card Menu for Third Party Data --}}
    <div class="row notosanLao">
        <div class="col-md-12">
            <h3 class="text-center">ລາຍການປະກັນໄພບຸກຄົນທີ3</h3>
        </div>
    </div>
    <hr>
    {{-- Card Menu --}}
    <div class="row notosanLao">
        {{-- Insurance Item is waiting for payment from customer --}}
        <div class="col-md-3">
            <div class="card border-secondary mb-3">
                <div class="card-header bg-secondary border-secondary text-white text-center fs-4"> <i class="bi bi-send-plus-fill me-2"></i> ລາຍການລໍຖ້າການຊຳລະເງິນ</div>
                <div class="card-body text-success text-center" >
                    <a type="button" href="{{route('AdminController.listOfThirdPartyInsuranceWaitForPayment')}}" class="btn btn-light border mb-2" style="width: 100%">
                        ລາຍການທັງໝົດ <span class="ms-2 badge bg-danger">{{sizeof($thirPartyNewPurchase)}}</span>
                    </a>
                    {{-- <ul class="list-group">
                        @foreach ($thirPartyNewPurchase as $item)
                            <li class="list-group-item">ເລກທະບຽນລົດ: <a href="{{route('AdminController.thirdPartyWaitForPaymentDetail',['id'=>$item->id])}}">{{$item->number_plate}}</a></li>
                        @endforeach
                      </ul> --}}
                </div>
            </div>
        </div>
        {{-- Insurance Payment Already Wait for approve --}}
        <div class="col-md-3">
            <div class="card border-success mb-3" >
                <div class="card-header bg-success border-success text-white text-center fs-4"><i class="bi bi-cash-coin me-2"></i> ລາຍການລໍຖ້າອານຸມັດ</div>
                <div class="card-body text-success text-center" >
                    <a href="{{route('AdminController.showAllPaymentItem')}}"  class="btn btn-light border mb-2" style="width: 100%">
                        ລາຍການທັງໝົດ <span class="ms-2 badge bg-danger">{{sizeof($thirdPartyWaitForApprove)}}</span>
                    </a>
                    {{-- <ul class="list-group">
                        @foreach ($thirdPartyWaitForApprove as $item)
                            <li class="list-group-item">ເລກທະບຽນລົດ: <a href="{{route('AdminController.thirdPartyWaitForApproveDetail',['id'=>$item->id])}}">{{$item->number_plate}}</a></li>
                        @endforeach
                      </ul> --}}
                </div>
            </div>
        </div>
        {{-- Insurance In Contract --}}
        <div class="col-md-3">
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary border-primary text-white text-center fs-4"><i class="bi bi-body-text me-2"></i> ລາຍການຢູ່ໃນສັນຍາ</div>
                <div class="card-body text-success text-center" >
                    <a href="{{route('AdminController.showAllApprovedItem')}}" class="btn btn-light border mb-2" style="width: 100%">
                        ລາຍການທັງໝົດ <span class="ms-2 badge bg-danger">{{sizeof($inContracts)}}</span>
                    </a>
                    {{-- <ul class="list-group">
                        @foreach ($inContracts as $item)
                            <li class="list-group-item">ເລກທະບຽນລົດ: <a class="" href="{{route('AdminController.showInsuranceInContract',['id'=>$item->id])}}">{{$item->number_plate}}</a></li>
                        @endforeach
                      </ul> --}}
                </div>
            </div>
        </div>

         {{-- Insurance Out Of Contract --}}
         <div class="col-md-3">
            <div class="card border-danger mb-3">
                <div class="card-header bg-danger border-danger text-white text-center fs-4"><i class="bi bi-exclamation-diamond-fill me-2"></i> ລາຍການທີ່ໝົດສັນຍາພາຍໃນ 14 ວັນ</div>
                <div class="card-body text-success text-center">
                    <a href="{{route('AdminController.showAllOutOfContract')}}" class="btn btn-light border mb-2" style="width: 100%">
                        ລາຍການທັງໝົດ <span class="ms-2 badge bg-danger">{{sizeof($outOfContracts)}}</span>
                    </a>
                    {{-- <ul class="list-group">
                        @foreach ($outOfContracts as $item)
                            <li class="list-group-item">ເລກທະບຽນລົດ: <a class="" href="{{route('AdminController.viewOutOfContract',['id'=>$item->id])}}">{{$item->number_plate}}</a></li>
                        @endforeach
                      </ul> --}}
                </div>
            </div>
        </div>
    </div>


@endsection
