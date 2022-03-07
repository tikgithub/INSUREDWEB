@extends('layouts.public_layout')
@section('content')
    <div class="pt-5"></div>
    {{-- Show Level detail --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" href="{{ route('welcome') }}">ໜ້າຫຼັກ</a>
            <li class="breadcrumb-item"><a class="text-dark text-decoration-none"
                    href="{{ URL::previous() }}">ລາຍການປະກັນໄພບຸກຄົ້ນທີ 3</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">ລາຍການຄຸ້ມຄອງ</li>
        </ol>
    </nav>
    <hr>
    {{-- Search Panel here --}}

    <div class="row notosanLao">
        <div class="col-md-12">
            <div class="text-center">
                <img src="{{ asset($packageDetail->logo) }}" style="width: auto; height: 150px;" class="rounded">
            </div>
            <div class="pt-1"></div>
            <h3 class="text-center">ລາຍການຄຸ້ມຄອງ ຂອງ {{ $packageDetail->package_name }}</h3>
        </div>
    </div>

    {{-- Display Cover Item here --}}

    <div class="row notosanLao">
        <div class="col-md-4 offset-md-4">
            <table class="table table-sm table-hover">
                <thead>
               
                    <th>ລາຍການ</th>
                    <th class="text-end">ວົງເງິນຄຸ້ມຄອງ</th>
                </thead>
                <tbody>
                   @foreach ($coverDetails as $item)
                       <tr>
              
                           <th>{{$item->name}}</th>
                           <th class="text-end">{{number_format($item->price,0)}}</th>
                       </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
