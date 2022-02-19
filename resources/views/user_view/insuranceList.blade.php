@php
 use Illuminate\Support\Facades\DB;
 use App\Models\InsuranceCompany;
 use App\Models\VehiclePackage;
 use App\Models\SaleOption;
 use App\Models\Level;
 use App\Models\CarBrand;
 use App\Models\Province;

@endphp

@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="notosanLao text-center">
                ລາຍການປະກັນໄພຜ່ານມາ
            </h2>
        </div>
    </div>
    {{-- Navigation --}}
       {{-- Show Level detail --}}
       <nav aria-label="breadcrumb" >
        <ol class="breadcrumb notosanLao">
          <li class="breadcrumb-item"><a href="{{route('welcome')}}">ໜ້າຫຼັກ</a></li>
          <li class="breadcrumb-item active" aria-current="page">ລາຍການປະກັນໄພ ຂອງ {{Auth::user()->firstname . ' ' . Auth::user()->lastname}}</li>
        </ol>
      </nav>
      <hr>
      <div class="row">
          <div class="col-md-3">

          </div>
          <div class="col-md-9">
         
              @foreach ($orderData as $item)
                  <div class="bg-white border item-container rounded">
                      @php
                          $company = InsuranceCompany::find(VehiclePackage::find(SaleOption::find($item->sale_options_id)->vp_id)->c_id);
                          $level = Level::find(VehiclePackage::find(SaleOption::find($item->sale_options_id)->vp_id)->lvl_id);
                          $saleOption = SaleOption::find($item->sale_options_id);
                      @endphp
                      <div class="align-middle">
                          <div class="row">
                              <div class="col-md-1 text-center align-self-center pt-2">
                                    <img src="{{asset($company->logo)}}" class="company-logo rounded">
                              </div>
                              <div class="col-md-8 text-center align-self-center pt-2">
                                    <span class="ms-1 notosanLao fs-4">{{$company->name . ' ' . $level->name .' '. $saleOption->name}}</span>
                              </div>
                              <div class="col-md-3 text-center align-self-center pt-2">
                                <span class="notosanLao fs-4 fw-bolder text-danger">
                                    {{number_format($item->total_price,0)}}
                                </span>
                              </div>
                          </div>
                      </div>

                      <div class="row pt-2">
                        <div class="col-md-12 text-center">
                                <span>
                                    @switch($item->payment_confirm)
                                        @case(null)
                                        <span class="badge rounded-pill notosanLao fs-6 bg-primary">ລໍຖ້າຢັງຢືນການຈ່າຍເງິນ</span>
                                            @break
                                        @case(2)
                                            
                                            @break
                                        @default
                                            
                                    @endswitch
                                </span>
                                
                        </div>
                    </div>

                    <hr>
                    {{-- Insurance Content --}}
                      <div class="row">
                          <div class="col-md-12">
                              <div class="d-flex justify-conent-between fs-6">
                                <img class="car-image rounded" src="{{asset($item->front_image)}}" alt="" srcset="">
                                <span class="ms-2 notosanLao">
                                    @php
                                        $vehicleBrand = CarBrand::find($item->vehicle_brand);
                                    @endphp
                                   
                                    <table>
                                        <tr>
                                            <td width="100" class="fw-bold">ຍີ່ຫໍ້ລົດ</td>
                                            <td>{{$vehicleBrand->name}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">ເລກທະບຽນ</td>
                                            <td>{{Province::find($item->registered_province)->province_name}} {{$item->number_plate}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">ເລກຈັກ</td>
                                            <td>{{$item->engine_number}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">ເລກຖັງ</td>
                                            <td>{{$item->chassic_number}}</td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr>
                                            
                                            <td><a href="http://" class="btn btn-sm btn-primary"><i class="bi bi-info-circle"></i> ລາຍລະອຽດການຄຸ້ມຄອງ</a></td>
                                            <td><a href="http://" class="btn btn-sm btn-success"><i class="bi bi-cash-stack"></i> ຈ່າຍເງິນ</a></td>
                                            <td><a href="http://" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i> ຍົກເລີກ</a></td>
                                        </tr>
                                    </table>
                                </span>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="pt-3"></div>
              @endforeach
          </div>
      </div>
<div class="fixed-bottom">
    @include('layouts.footer')
</div>
@endsection

@section('styles')
    <style>
        .item-container{
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .company-logo{
            width: auto;
            height: 50px;
        }
        .car-image{
            width: 150px;
            height: auto;
        }
    </style>
@endsection