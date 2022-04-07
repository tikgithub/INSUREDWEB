@extends('layouts.public_layout')
@section('content')
{{-- Padding --}}
<div class="pt-5"></div>
<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="notosanLao">ເລືອກການຈ່າຍເງິນ</h3>
    </div>
</div>
{{-- List of available payment provider --}}
<div class="row">
    <div class="col-md-6 offset-md-3">
        @foreach ($paymentProviders as $item)
            <div class="d-grid pt-5">
                <a href="{{route('AccidentSaleController.showPaymentSubmitPage',['id'=>$item->id])}}" class="btn btn-light border p-3 shadow zoom ps-5 pe-5">
                    <img style="width: auto;height: 80px;" src="{{asset($item->logo)}}" class="provider-logo">
                    <h3 class="notosanLao text-center"><u>{{$item->name}}</u></h3>
                    <div class="pt-2"></div>
                    <span><b class="fs-5">{{$item->account}}</b></span>
                </a>
               
            </div>
        @endforeach
    </div>
</div>

@endsection
@section('footer')
<div class="">
    @include('layouts.footer')
</div>
@endsection
@section('styles')
@endsection