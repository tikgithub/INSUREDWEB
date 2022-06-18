@extends('layouts.public_layout')
@section('content')
<div class="pt-5"></div>
{{-- Header --}}
<div class="row">
    <div class="col-md-12">
        <h2 class="notosanLao text-center">
            ປຽບທຽບປະກັນໄພ
        </h2>
    </div>
</div>
{{-- End Header --}}

   {{-- Show Level detail --}}
   <nav aria-label="breadcrumb">
    <ol class="breadcrumb notosanLao">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">ໜ້າຫຼັກ</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('InsuranceFlowController.showCarInsuranceSelectionMenu') }}">ຊື້ໄປະກັນໄພ</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{"ຄົ້ນຫາປະກັນໄພ"}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{"ປຽບທຽບປະກັນໄພ"}}</li>
    </ol>
</nav>
<hr>

{{-- Package Label Show --}}
<div class="pt-2"></div>
<div class="row">
    {{-- First Select --}}
    <div class="col-md-5">
        <div class="d-flex justify-content-center p-2">
            <div class="card" style="width: 18.5rem;">
                @if (!trim($companyFirst->logo))
                <img src="{{ asset('assets/image/200x120.png') }}" class="rounded img-fluid me-2"
                    alt="200x12" srcset="" style="width: 300px; height: 200px;">
            @else
                <img src="{{ asset($companyFirst->logo) }}" alt="200x12" srcset=""
                    style="width: 300px; height: 200px;" class="rounded img-fluid me-2">
            @endif
                <div class="card-body notosanLao">
                  <h5 class="card-title">{{$companyFirst->name}} {{$vehiclePackageFirst->name}} ({{$saleOptionFirst->name}})</h5>
                  <p class="card-text text-danger text-center fs-3 fw-bolder">{{number_format($saleOptionFirst->sale_price,0)}}</p>
                  {{-- Buy botton --}}
            <div class="d-flex justify-content-center">
                <a href="{{route('InsuranceFlowController.showBuyNowPage',['sale_id'=>$saleOptionFirst->id])}}" class="notosanLao btn-danger btn btn-lg border m-1"><i class="bi bi-bag-check"></i> ຊື້ເລີຍ</a>
            </div>
                </div>
              </div>
        </div>
    </div>
    {{-- Middle --}}
    <div class="col-md-2 align-self-center text-center">
        <img src="{{asset('assets/image/vs.png')}}" class="img-fluid" alt="" srcset="">
    </div>
    {{-- Second Select --}}
    <div class="col-md-5">
        <div class="d-flex justify-content-center p-2">
            <div class="card" style="width: 18.5rem;">
                @if (!trim($companySecond->logo))
                <img src="{{ asset('assets/image/200x120.png') }}" class="rounded img-fluid me-2"
                    alt="200x12" srcset="" style="width: 300px; height: 200px;">
            @else
                <img src="{{ asset($companySecond->logo) }}" alt="200x12" srcset=""
                    style="width: 300px; height: 200px;" class="rounded img-fluid me-2">
            @endif
                <div class="card-body notosanLao">
                
                    <h5 class="card-title">{{$companySecond->name}} {{$vehiclePackageSecond->name}} ({{$saleOptionSecond->name}})</h5>
                    <p class="card-text text-danger text-center fs-3 fw-bolder">{{number_format($saleOptionSecond->sale_price,0)}}</p>
                     {{-- Buy botton --}}
            <div class="d-flex justify-content-center">
                <a href="{{route('InsuranceFlowController.showBuyNowPage',['sale_id'=>$saleOptionSecond->id])}}" class="notosanLao btn-danger btn btn-lg border m-1"><i class="bi bi-bag-check"></i> ຊື້ເລີຍ</a>
            </div>
                </div>
              </div>
        </div>
    </div>
</div>
{{-- End Package Label Show --}}
{{-- Detail of Insured --}}
<div class="row">
    <div class="col-md-6">
        <table class="table notosanLao table-bordered table-sm">
            <thead class="fs-5 bg-blue text-white">

                <td>ລາຍລະອຽດການຄຸ່ມຄອງປະກັນໄພ</td>
                <td>ວົງເງິນຄຸ່ມກັນ</td>

            </thead>
            <tbody>
                @php
                    $group_id = 0;
                    
                @endphp
                @foreach ($saleDetailsFirst as $item)
                    {{-- start tr --}}
                    <tr>
                        @if ($group_id != $item->group_id) 
                            <td colspan="3" class="fs-5">{{ $item->group_name }} </td>
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td class="fs-4">{{ number_format($item->cover_price, 0) }}</td>
                    </tr>
                @endif

                @if ($group_id == $item->group_id)
                    <td>{{ $item->item_name }}</td>
                    <td class="fs-4">{{ number_format($item->cover_price, 0) }}</td>
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
    <div class="col-md-6">
        <table class="table notosanLao table-bordered table-sm">
            <thead class="fs-5 bg-blue text-white">

                <td>ລາຍລະອຽດການຄຸ່ມຄອງປະກັນໄພ</td>
                <td>ວົງເງິນຄຸ່ມກັນ</td>

            </thead>
            <tbody>
                @php
                    $group_id = 0;
                    
                @endphp
                @foreach ($saleDetailsSecond as $item)
                    {{-- start tr --}}
                    <tr>
                        @if ($group_id != $item->group_id)
                            <td colspan="3" class="fs-5">{{ $item->group_name }} </td>
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td class="fs-4">{{ number_format($item->cover_price, 0) }}</td>
                    </tr>
                @endif

                @if ($group_id == $item->group_id)
                    <td>{{ $item->item_name }}</td>
                    <td class="fs-4">{{ number_format($item->cover_price, 0) }}</td>
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

@endsection
@section('footer')
<div class="">
    @include('layouts.footer')
</div>
@endsection