@extends('layouts.public_layout')

@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>

    {{-- Show Level detail --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a
                href="{{ route('InsuranceFlowController.showInsuranceTypeSelection') }}">ຊື້ປະກັນໄພ</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('InsuranceFlowController.showCarInsuranceSelectionMenu') }}">ເລືອກຮູບແບບປະກັນໄພ</a></li>
            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ $level->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $company->name }} {{ $level->name }}
                {{ $saleOption->name }}</li>
        </ol>
    </nav>
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center">
            @if (!trim($company->logo))
                <img src="{{ asset('assets/image/200x120.png') }}" class="rounded img-fluid me-2" alt="200x12" srcset=""
                    style="width: 200px; height: 120px;">
            @else
                <img src="{{ asset($company->logo) }}" alt="200x12" srcset="" style="width: 200px; height: 120px;"
                    class="rounded img-fluid me-2">
            @endif
            <h2 class="notosanLao mt-2">
                {{ $company->name }} {{ $vehiclePackage->name }}
            </h2>
            <h3 class="notosanLao mt-1">
                {{ $level->name }} {{ $saleOption->name }}
            </h3>
        </div>
    </div>
    {{-- Table Body --}}
    <div class="row">
        <div class="col-md-12">
            {{-- Summary Page --}}
         
                <div  class="d-flex justify-content-start notosanLao">
                   <b>
                    <span class="fs-4">{{ 'ລວມຄ່າທຳນຽມທີ່ຕ້ອງຈ່າຍ : ' }} </span>
                    <span class="fs-4 text-danger">{{ number_format($saleOption->sale_price, 0) }} ₭</span>
                   </b>
                </div>
         
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table notosanLao table-bordered">
                <thead class="fs-4 bg-blue text-white">

                    <td>ລາຍລະອຽດການຄຸ່ມຄອງປະກັນໄພ</td>
                    <td>ວົງເງິນຄຸ່ມກັນ</td>

                </thead>
                <tbody>
                    @php
                        $group_id = 0;
                        
                    @endphp
                    @foreach ($saleDetails as $item)
                        {{-- start tr --}}
                        <tr>
                            @if ($group_id != $item->group_id)
                                <td colspan="3" class="fs-4">{{ $item->group_name }} </td>
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ number_format($item->cover_price, 0) }} ₭</td>
                        </tr>
                    @endif

                    @if ($group_id == $item->group_id)
                        <td>{{ $item->item_name }}</td>
                        <td>{{ number_format($item->cover_price, 0) }} ₭</td>
                    @endif
                    @php
                        $group_id = $item->group_id;
                    @endphp
                    </tr>
                    {{-- End tr --}}
                   
                    @endforeach
                    
                </tbody>
            </table>

            {{-- Buy botton --}}
            <div class="d-flex justify-content-center">
                <a href="" class="notosanLao btn-danger btn btn-lg border m-1"><i class="bi bi-bag-check"></i> ຊື້ເລີຍ</a>
            </div>

        </div>
    </div>
    <div class="fixed-bottom">
        @include('layouts.footer')
    </div>
@endsection
