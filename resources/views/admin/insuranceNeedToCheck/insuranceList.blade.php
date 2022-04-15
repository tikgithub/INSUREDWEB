@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>

    <div class="row mb-3">
        <div class="col-md-12 border rounded">
            <h4>Filter</h4>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <table class="table table-sm table-hover">
                <thead class="fw-bold">
                    
                    <th>ບໍລິສັດປະກັນ</th>
                    <th>Package</th>
                    <th>ຜູ້ເອົາປະກັນ</th>
                    <th>ເລກທະບຽນລົດ/ຂຶ້ນທະບຽນທີ່</th>
                    <th>User ທີ່ຊື້ປະກັນໄພ</th>
                    <th>ວັນທີ່ຈ່າຍເງິນ</th>
                    <th>ປະເພດປະກັນໄພ</th>
                    <th>ສະຖານະ</th>
                    
                    <th class="text-end"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($vehichelInsuranceData as $item)
                        <tr>
                            <td>{{$item->company_name}}</td>
                            <td>{{$item->package_name}} {{$item->level_name}}</td>
                            <td>{{$item->insuredName}}</td>
                            <td><span class="text-danger fw-bold lead"><u>{{$item->number_plate}}</u></span> {{$item->registeredProvince}}</td>
                            <td>{{$item->accountName}}</td>
                            <td>{{$item->payment_time}}</td>
                            <td>
                                @include('admin.insuranceNeedToCheck.insuranceStatus')
                            </td>
                            <td>
                                @include('admin.insuranceNeedToCheck.alertComponent')
                            </td>
                            <td>
                                <a href="http://" class="btn btn-sm btn-warning">ກວດສອບ</a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($thirdPartyInsuranceData as $item)
                        <tr>
                            <td>{{$item->company_name}}</td>
                            <td>{{$item->package_name}} {{$item->level_name}}</td>
                            <td>{{$item->insuredName}}</td>
                            <td><span class="text-danger fw-bold lead"><u>{{$item->number_plate}}</u></span> {{$item->registeredProvince}}</td>
                            <td>{{$item->accountName}}</td>
                            <td>{{$item->payment_time}}</td>
                            <td>
                                @include('admin.insuranceNeedToCheck.insuranceStatus')
                            </td>
                            <td>
                                @include('admin.insuranceNeedToCheck.alertComponent')
                            </td>
                            <td>
                                <a href="http://" class="btn btn-sm btn-warning">ກວດສອບ</a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($accidentInsuranceData as $item)
                        <tr>
                            <td>{{$item->company_name}}</td>
                            <td>{{$item->package_name}} {{$item->plan_name}}</td>
                            <td>{{$item->insuredName}}</td>
                            <td class="text-center">--</td>
                            <td>{{$item->accountName}}</td>
                            <td>{{$item->payment_time}}</td>
                            <td>
                                @include('admin.insuranceNeedToCheck.insuranceStatus')
                            </td>
                            <td>
                                @include('admin.insuranceNeedToCheck.alertComponent')
                            </td>
                            <td>
                                <a href="http://" class="btn btn-sm btn-warning">ກວດສອບ</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
        </div>
    </div>
@endsection
