@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>

    {{-- Header Title --}}
    <div class="row">
        <div class="notosanLao col-md-12 text-center">
            <h2>ເລືອກ ແພັກແກັດປະກັນໄພທີ່ຕ້ອງການ</h2>
        </div>
    </div>
    <div class="pt-5"></div>
    {{-- End Header Title --}}
    @php
    use App\Models\AccidentPlan;
    @endphp
    <div class="row row-cols-1 row-cols-md-3 g-4 notosanLao">
        @foreach ($accidentDetails as $item)
            <div class="col zoom">

                <div class="card mb-4">
                    <div class="card-header bg-blue">
                        <h3 class="card-title text-white text-center"><b>{{ $item->name }} {{ $item->id }}</b></h3>
                    </div>
                    <div class="card-body text-center">
                        @php
                            $plans = AccidentPlan::where('cover_type_id', '=', $item->id)->get();
                        @endphp
                        <div class="row">
                            <div class="col-xs-12 text-start">
                                @foreach ($plans as $itemPlan)
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('AccidentSaleController.showPlanDetail', ['plan_id' => $itemPlan->id]) }}"
                                            class="btn btn-outline-secondary me-2 mb-2 text-dark">
                                            <span class="fs-3">{{ $itemPlan->name }}</span> <br><b
                                                class="fs-4"> {{ number_format($itemPlan->sale_price, 0) }}
                                                ກີບ/ປີ</b>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        @endforeach
    </div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
