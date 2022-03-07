@extends('layouts.public_layout')
@section('content')
<div class="pt-5"></div>
<div class="row notosanLao">
    <div class="col-md-12">
       
        <div class="pt-1"></div>
        <h3 class="text-center">ປຽບທຽບລາຍການ</h3>
    </div>
</div>

    {{-- Show Level detail --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a class="text-dark text-decoration-none" href="{{ route('welcome') }}">ໜ້າຫຼັກ</a>
            <li class="breadcrumb-item"><a class="text-dark text-decoration-none"
                    href="{{ URL::previous() }}">ລາຍການປະກັນໄພບຸກຄົ້ນທີ 3</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">ປຽບທຽບລາຍການ</li>
        </ol>
    </nav>
    <hr>
    {{-- Search Panel here --}}

    <div class="row notosanLao">
        <div class="col-md-5">
            <div class="card">
                <img src="{{asset($packageDetail1->logo)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$packageDetail1->package_name}}</h5>
                    <p class="card-text">{{$packageDetail1->vehicle_types}} {{$packageDetail1->vehicle_details}}</p>
                    <p class="card-text text-danger fw-bold fs-4">₭ {{number_format($packageDetail1->final_price,0)}}</p>
                    <p class="card-text text-center">
                        <a href="http://" class="btn btn-danger text-white"><i class="bi bi-cart me-2"></i> ຊື້ເລີຍ</a>
                    </p>
                </div>
            </div>
            <div class="row notosanLao pt-2">
                <div class="col-md-12">
                    <table class="table table-sm table-hover bg-white">
                        <thead>
                       
                            <th>ລາຍການ</th>
                            <th class="text-end">ວົງເງິນຄຸ້ມຄອງ</th>
                        </thead>
                        <tbody>
                           @foreach ($coverDetail1 as $item)
                               <tr>
                      
                                   <th>{{$item->name}}</th>
                                   <th class="text-end">{{number_format($item->price,0)}}</th>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-2 align-self-center">
            <img src="{{asset('assets/image/vs.png')}}" class="img-fluid" alt="" srcset="">
        </div>
        <div class="col-md-5">
            <div class="card">
                <img src="{{asset($packageDetail2->logo)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$packageDetail2->package_name}}</h5>
                    <p class="card-text">{{$packageDetail2->vehicle_types}} {{$packageDetail2->vehicle_details}}</p>
                    <p class="card-text text-danger fw-bold fs-4">₭ {{number_format($packageDetail2->final_price,0)}}</p>
                    <p class="card-text text-center">
                        <a href="http://" class="btn btn-danger text-white"><i class="bi bi-cart me-2"></i> ຊື້ເລີຍ</a>
                    </p>
                </div>
            </div>
            <div class="row notosanLao pt-2">
                <div class="col-md-12">
                    <table class="table table-sm table-hover bg-white">
                        <thead>
                       
                            <th>ລາຍການ</th>
                            <th class="text-end">ວົງເງິນຄຸ້ມຄອງ</th>
                        </thead>
                        <tbody>
                           @foreach ($coverDetail2 as $item)
                               <tr>
                      
                                   <th>{{$item->name}}</th>
                                   <th class="text-end">{{number_format($item->price,0)}}</th>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection