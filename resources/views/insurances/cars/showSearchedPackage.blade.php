{{-- Import using --}}
@php
use Illuminate\Support\Facades\DB;
use App\Models\SaleOption;
@endphp

@extends('layouts.public_layout')

@section('scripting')
    <script>
        var firstButton;
        var secondButton;

        function onClickCompare(id) {

            var clickButton = document.getElementById(id);
            if (firstButton == null) {
                firstButton = clickButton;
                firstButton.innerHTML = "<i class='bi bi-check-all'></i> ປຽບທຽບ";
                firstButton.classList.remove('btn-warning');
                firstButton.classList.add('btn-info');
            } else {

                secondButton = clickButton;
                secondButton.innerHTML = "<i class='bi bi-check-all'></i> ປຽບທຽບ";
                secondButton.classList.remove('btn-warning');
                secondButton.classList.add('btn-info');
                //Goto new Compare page
                var url = window.location.origin + "/insurance/compare/option/" + firstButton.getAttribute('id') + '/' +
                    secondButton.getAttribute('id');
                window.location = url;
            }

        }
        /* If browser back button was used, flush cache */
        (function() {
            window.onpageshow = function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
            };
        })();
    </script>
@endsection

@section('content')
    <div class="pt-5"></div>
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="notosanLao">ເລືອກແພັກແກັດ</h3>
        </div>
    </div>
    {{-- Show Level detail --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a
                href="{{ route('InsuranceFlowController.showInsuranceTypeSelection') }}">ຊື້ປະກັນໄພ</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('InsuranceFlowController.showCarInsuranceSelectionMenu') }}">ເລືອກຮູບແບບປະກັນໄພ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $level->name }}</li>
        </ol>
    </nav>
    <hr>
    {{-- List of available package --}}
    <div class="row">
        {{-- Navigation or filter bar --}}
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <form action="" method="get">
                        <label for="range" class="form-label notosanLao fs-4">ເລືອກຊ່ວງລາຄາ(<span
                                id="range_value">0</span>)</label>
                        <input type="hidden" name="level" value="{{ $level->id }}">
                        <input type="range" class="form-range" step="10000" value="100000" id="range" min="100000"
                            max="20000000" oninput="showVal(this.value)" onchange="showVal(this.value)">
                        <div class="d-flex justify-content-between notosanLao">
                            <span>{{ number_format(100000, 0) }} ກີບ</span>
                            <span>{{ number_format(20000000, 0) }} ກີບ</span>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn bg-blue bg-lg notosanLao text-white">ຄົ້ນຫາ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Package Container --}}
        <div class="col-md-9">
            {{-- Sorting By Price --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <form action="" method="get" class="notosanLao " style="">
                        <div class="col-12" style="display: inline-flex">
                            <input type="hidden" name="level" value="{{ $level->id }}">
                            <select name="sorting" id="sorting" class="form-select">
                                <option value="">ລາຄາໜ້ອຍ-ຫຼາຍ</option>
                                <option value="">ລາຄາຫຼາຍ-ໜ້ອຍ</option>
                            </select>
                            <button class="btn bg-blue text-white notosanLao ms-2">ຕົກລົງ</button>
                        </div>
                    </form>
                </div>
            </div>
            @foreach ($packages as $item)
                {{-- Padding --}}
                <div class="pt-2"></div>
                <div class="card bg-gray">
                    <div class="card-body">
                        {{-- Padding --}}
                        <div class="pt-3"></div>
                        <h2 class="notosanLao text-center">{{ $item->company_name }} {{ $item->package_name }}</h2>
                        <h3 class="notosanLao text-center">{{ $item->level_name }}</h3>

                        <div class="row">
                            {{-- Picture of company --}}
                            <div class="col-md-4 text-center align-self-center">
                                @if (!trim($item->logo))
                                    <img src="{{ asset('assets/image/200x120.png') }}" class="rounded img-fluid me-2"
                                        alt="200x12" srcset="" style="width: 200px; height: 120px;">
                                @else
                                    <img src="{{ asset($item->logo) }}" alt="200x12" srcset=""
                                        style="width: 200px; height: 120px;" class="rounded img-fluid me-2">
                                @endif
                                @if ($item->start_rank)
                                    <p class="notosanLao mt-2 fs-6 badge bg-primary text-wrap">
                                        ມູນຄ່າລົດທີ່ສາມາດຊື້ໄດ້ {{ number_format($item->start_rank, 0) }} USD ຫາ
                                        {{ number_format($item->end_rank, 0) }} USD
                                    </p>
                                @endif
                            </div>
                            {{-- The Available Option --}}
                            <div class="col-md-8">
                                @php
                                    $saleOptions = SaleOption::where('vp_id', '=', [$item->Id])->get();
                                @endphp

                                @foreach ($saleOptions as $saleItem)
                                    <div class="row mb-1 rounded text-white">
                                        <div class="col-md-12 text-center">
                                            <span>
                                                <a href="{{ route('InsuranceFlowController.showNormalPackageDetail', ['sale_id' => $saleItem->id]) }}"
                                                    class="notosanLao btn fs-4 bg-success text-dark m-1">
                                                    <span class="text-white"><i class="bi bi-tag"></i>
                                                        {{ $saleItem->name }}, ລາຄາ: </span> <b
                                                        class="fs-3 text-danger">{{ number_format($saleItem->sale_price, 0) }}
                                                        ₭</b>
                                                </a>
                                            </span>
                                            <span>
                                                <button class="notosanLao btn-warning btn border m-1"
                                                    id="{{ $saleItem->id }}"
                                                    onclick="onClickCompare({{ $saleItem->id }})"><i
                                                        class="bi bi-ui-checks"></i> ປຽບທຽບ</button>
                                                <a href="{{route('InsuranceFlowController.showBuyNowPage',['sale_id'=>$saleItem->id])}}" class="notosanLao btn-danger btn border m-1"><i
                                                        class="bi bi-bag-check"></i> ຊື້ເລີຍ</a>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach


                            </div>
                        </div>
                    </div>
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
@section('scripting')
    <script>
        function showVal(value) {
            var rangeValue = document.getElementById('range_value');
            rangeValue.innerHTML = numberWithCommas(value) + " ກີບ";
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
@endsection
