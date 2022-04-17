@extends('layouts.public_layout')
@section('content')
     {{-- Padding --}}
     <div class="pt-5"></div>

     {{-- Header Title --}}
     <div class="row mb-2">
        
         <div class="notosanLao col-md-12 text-center">
            <img src="{{asset($headerTitleData->logo)}}" class="rounded mb-2" style="width: auto;height: 70px;">
             <h2>ລາຍລະອຽດຂອງປະກັນໄພ</h2>
         </div>
     </div>
     <div class="row">
         <div class="col-md-12 text-center">
             <h2>
                  {{$headerTitleData->company_name}} {{$headerTitleData->cover_name}} - <b>{{$headerTitleData->plan_name}}</b>
             </h2>
             
         </div>
     </div>
     
     {{-- End Header Title --}}

     <div class="row mb-2">
         <div class="col-md-6 offset-md-3">
             <hr>
             <h5>
                 ເງືອນໄຂອາຍຸລະວ່າງ: {{$plan->start_age}} - {{$plan->end_age}}
             </h5>
             <table class="table table-hover table-bordered">
                <thead class="bg-blue text-white fs-4">
                    <th>#</th>
                    <th>ລາຍການຄຸ້ມຄອງ</th>
                    <th class="text-end">ວົງເງິນຄຸ້ມຄອງ</th>
                </thead>
                <tbody>
                    @foreach ($coverData as $item)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td class="fs-5">{{$item->name}}</td>
                            <td class="text-end fs-5">{{number_format($item->cover_price,0)}} ກີບ</td>
                        </tr>
                    @endforeach
                </tbody>
               <tfoot>
                   <tr>
                       <td colspan="2" class="fs-4 fw-bold">
                           ລວມຄ່າທຳນຽມຕໍ່ປີ
                       </td>
                       <td class="text-end fs-4 fw-bold">
                            {{number_format($plan->sale_price,0)}} ກີບ
                       </td>
                   </tr>
               </tfoot>
             </table>
         </div>
     </div>
     <div class="row">
         <div class="col-md-6 offset-md-3 text-center">
            <a href="{{route('HeathSaleController.ShowCustomerInput',['plan_id'=>$headerTitleData->plan_id])}}" class="btn btn-success btn-lg">ຊື້ເລີຍ</a>
         </div>
     </div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection