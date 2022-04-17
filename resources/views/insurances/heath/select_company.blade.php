@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>

    {{-- Header Title --}}
    <div class="row">
        <div class="notosanLao col-md-12 text-center">
            <h1>ປະກັນໄພອຸບັດຕິເຫດ ເລືອກບໍລິສັດປະກັນໄພ</h1>
        </div>
    </div>
    <div class="pt-5"></div>
    <div class="pt-5"></div>
    {{-- End Header Title --}}
    <div class="row row-cols-1 row-cols-md-3 g-4 notosanLao">
        @foreach ($companyData as $item)  
            <div class="col zoom p-5 d-flex justify-content-center">
                <a href="{{route('HeathSaleController.ShowPackage',['company_id'=>$item->company_id])}}" class="text-decoration-none text-dark">
                    <div class="card " style="width: 19.8rem; cursor: pointer;">
                        <img src="{{ asset($item->logo) }}" style="object-fit: cover; height: 200px; width: auto">
                        <div class="card-body text-center">
                            <hr>
                            <h3 class="card-title"><b>{{ $item->company_name }}</b></h3>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
