@php
    use App\Models\User;
    use App\Models\Province;
    use App\Models\InsuranceCompany;
    use App\Models\Level;
    use App\Models\SaleOption;
    use App\Models\VehiclePackage;
@endphp

@extends('layouts.admin_layout')
@section('content')
{{-- Padding --}}
<div class="pt-5"></div>
 {{-- Navigation --}}
 <nav aria-label="breadcrumb ">
    <ol class="breadcrumb notosanLao">
      <li class="breadcrumb-item"><a href="{{route('AdminController.showAdminDashBoard')}}">ໜ້າຫຼັກ</a></li>
      <li class="breadcrumb-item active" aria-current="page">ລາຍການໝົດໃກ້ປະກັນ</li>
    </ol>
  </nav>
<hr>
<div class="table-responsive">
    <table class="table table-hover table-sm">
        <thead class="notosanLao fs-5">
            <th>#</th>
            <th>AccountName</th>
            <th>ຜູ້ເອົາປະກັນ</th>
            <th>ເບີໂທ</th>
            <th>ແຂວງ</th>
            <th>ເລກທະບຽນລົດ</th>
            <th>ປະກັນທີຊື້</th>
            <th>ວັນທີໝົດປະກັນ</th>
        </thead>
        <tbody class="notosanLao">
            @foreach ($outOfContracts as $item)
                <tr style="cursor: pointer" onclick="show({{$item->id}})">
                    <td>{{$loop->index + 1 }}</td>
                    <td>
                        @php
                            $user = User::find($item->user_id)
                        @endphp
                        {{$user->firstname . ' ' . $user->lastname}}
                    </td>
                    <td>
                        {{$item->firstname .' '.$item->lastname}}
                    </td>
                    <td>
                        {{$item->tel}}
                    </td>
                    <td>
                        {{Province::find($item->province)->province_name}}
                    </td>
                    <td>
                         {{Province::find($item->registered_province)->province_name}}<br>{{$item->number_plate}}
                    </td>
                    <td>
                        @php
                            $company = InsuranceCompany::find(VehiclePackage::find(SaleOption::find($item->sale_options_id)->vp_id)->c_id);
                            $level = Level::find(VehiclePackage::find(SaleOption::find($item->sale_options_id)->vp_id)->lvl_id);
                            $saleOption = SaleOption::find($item->sale_options_id);
                        @endphp
                        {{ $company->name . ' ' . $level->name . ' ' . $saleOption->name }}
                    </td>
                    <td class="text-danger fw-bold">
                        {{Carbon\Carbon::parse($item->end_date)->format("d/m/Y")}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripting')
    <script>
        function show(id){
            console.log(tt);
            var url = "{{route('AdminController.viewOutOfContract',['id'=>':id'])}}";
            url = url.replace(':id',id);
            window.location = url;
        }
    </script>
@endsection
