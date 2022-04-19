@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-sm table-hover" id="table">
                <thead class="fw-bold">

                    <th>ບໍລິສັດປະກັນ</th>
                    <th>Package</th>
                    <th>ຜູ້ເອົາປະກັນ</th>
                    <th>ເລກທະບຽນລົດ/ຂຶ້ນທະບຽນທີ່</th>
                    <th>User ທີ່ຊື້ປະກັນໄພ</th>
                    <th>ວັນທີ່ຈ່າຍເງິນ</th>
                    <th>ອັບເດດລ່າສຸດ</th>
                    {{-- <th>ປະເພດປະກັນໄພ</th> --}}
                    <th>ສະຖານະ</th>
                    <th class="text-end"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($vehichelInsuranceData as $item)
                        <tr class="cursor">
                            {{-- {{ $item->package_name }} {{ $item->level_name }} --}}
                            <td>{{ $item->company_name }} </td>
                            <td>@include(
                                'admin.insuranceNeedToCheck.insuranceStatus'
                            )</td>
                            <td>{{ $item->insuredName }}</td>
                            <td><span class="text-danger fw-bold lead"><u>{{ $item->number_plate }}</u></span>
                                {{ $item->registeredProvince }}</td>
                            <td>{{ $item->accountName }}</td>
                            <td class="text-center">
                                {{ $item->payment_time ? \Carbon\Carbon::parse($item->payment_time)->format('d/m/Y | H:m') : 'N/A' }}

                                {{ $item->payment_time ? '|' . \Carbon\Carbon::parse($item->payment_time)->diffForHumans(null, true) : '' }}
                            </td>
                            <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y | H:m') : '' }}
                                {{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans(null, true) }}</td>
                            {{-- <td>
                                @include('admin.insuranceNeedToCheck.insuranceStatus')
                            </td> --}}
                            <td>
                                @include(
                                    'admin.insuranceNeedToCheck.alertComponent'
                                )
                            </td>
                            <td>
                                <a href="{{route('AdminInsuranceController.ShowPageDetailForApprove',['id'=>$item->insurance_id])}}" class="btn btn-sm btn-warning">ກວດສອບ</a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($thirdPartyInsuranceData as $item)
                        <tr class="cursor">
                            <td>{{ $item->company_name }}</td>
                            <td>@include(
                                'admin.insuranceNeedToCheck.insuranceStatus'
                            )</td>
                            <td>{{ $item->insuredName }}</td>
                            <td><span class="text-danger fw-bold lead"><u>{{ $item->number_plate }}</u></span>
                                {{ $item->registeredProvince }}</td>
                            <td>{{ $item->accountName }}</td>
                            <td class="text-center">
                                {{ $item->payment_time ? \Carbon\Carbon::parse($item->payment_time)->format('d/m/Y | H:m') : 'N/A' }}

                                {{ $item->payment_time ? '|' . \Carbon\Carbon::parse($item->payment_time)->diffForHumans(null, true) : '' }}
                            </td>
                            <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y | H:m') : '' }}
                                {{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans(null, true) }}</td>
                            {{-- <td>
                                @include('admin.insuranceNeedToCheck.insuranceStatus')
                            </td> --}}
                            <td>
                                @include(
                                    'admin.insuranceNeedToCheck.alertComponent'
                                )
                            </td>
                            <td>
                                <a href="{{route('AdminInsuranceController.ShowPageDetailForApprove',['id'=>$item->insurance_id])}}" class="btn btn-sm btn-warning">ກວດສອບ</a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($accidentInsuranceData as $item)
                        <tr class="cursor">
                            <td>{{ $item->company_name }}</td>
                            <td>@include(
                                'admin.insuranceNeedToCheck.insuranceStatus'
                            )</td>
                            <td>{{ $item->insuredName }}</td>
                            <td class="text-center">--</td>
                            <td>{{ $item->accountName }}</td>
                            <td class="text-center">
                                {{ $item->payment_time ? \Carbon\Carbon::parse($item->payment_time)->format('d/m/Y | H:m') : 'N/A' }}

                                {{ $item->payment_time ? '|' . \Carbon\Carbon::parse($item->payment_time)->diffForHumans(null, true) : '' }}
                            </td>
                            <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y | H:m') : '' }}
                                {{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans(null, true) }}</td>
                            {{-- <td>
                                @include('admin.insuranceNeedToCheck.insuranceStatus')
                            </td> --}}
                            <td>
                                @include(
                                    'admin.insuranceNeedToCheck.alertComponent'
                                )
                            </td>
                            <td>
                                <a href="{{route('AdminInsuranceController.ShowPageDetailForApprove',['id'=>$item->insurance_id])}}" class="btn btn-sm btn-warning">ກວດສອບ</a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($heathInsuranceData as $item)
                        <tr class="cursor">
                            <td>{{ $item->company_name }}</td>
                            <td>@include(
                                'admin.insuranceNeedToCheck.insuranceStatus'
                            )</td>
                            <td>{{ $item->insuredName }}</td>
                            <td class="text-center">--</td>
                            <td>{{ $item->accountName }}</td>
                            <td class="text-center">
                                {{ $item->payment_time ? \Carbon\Carbon::parse($item->payment_time)->format('d/m/Y | H:m') : 'N/A' }}

                                {{ $item->payment_time ? '|' . \Carbon\Carbon::parse($item->payment_time)->diffForHumans(null, true) : '' }}
                            </td>
                            <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y | H:m') : '' }}
                                {{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans(null, true) }}</td>
                            {{-- <td>
                                @include('admin.insuranceNeedToCheck.insuranceStatus')
                            </td> --}}
                            <td>
                                @include(
                                    'admin.insuranceNeedToCheck.alertComponent'
                                )
                            </td>
                            <td>
                                <a href="{{route('AdminInsuranceController.ShowPageDetailForApprove',['id'=>$item->insurance_id])}}" class="btn btn-sm btn-warning">ກວດສອບ</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .cursor{
            cursor: pointer;
        }
    </style>
@endsection

@section('scripting')
@include('toastrMessage')
    <script>
       
    </script>
@endsection


