@php
use App\Models\InsuranceCompany;
use App\Models\Level;
use App\Models\Vehicle_Detail;
@endphp

@extends('layouts.admin_layout')
@section('content')
    {{-- Padding Mode --}}
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page"> ກຳນົດຮູບແບບປະກັນໄພບຸກຄົນທີ 3</li>
        </ol>
    </nav>
    <hr>
    <h3 class="notosanLao text-center">ກຳນົດຮູບແບບປະກັນໄພບຸກຄົນທີ 3</h3>

    {{-- Search Panel --}}
    <hr>
    <div class="row notosanLao">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><i
                    class="bi bi-search"></i> ຄົ້ນຫາ</button>
        </div>
    </div>
    <hr>
    {{-- Table to display package --}}
    <div class="row notosanLao">
        <div class="col-md-12">
            <table class="table table-sm table-hover">
                <thead>
                    <th>#</th>
                    <th>ລາຍການ</th>
                    <th>ຊື່ບໍລິສັດ</th>
                    <th>ຊັ້ນປະກັນ</th>
                    <th>ຍານພາຫະນະ</th>
                    <th>ຄ່າທຳນຽມ</th>
                    <th>ລາຄາຂາຍ</th>
                    <th>ການໃຊ້ງານ</th>
                </thead>
                <tbody>
                    @foreach ($packages as $item)
                        <tr style="cursor: pointer" onclick="onClickItem('item-{{$item->id}}')">
                            <td>{{ $packages->firstItem() + $loop->index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ InsuranceCompany::find($item->company_id)->name }}</td>
                            <td>{{ Level::find($item->level)->name }}</td>
                            <td>{{ Vehicle_Detail::find($item->vehicle_detail)->name }}</td>
                            <td>{{ $item->fee }}</td>
                            <td>{{ $item->final_price }}</td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" onchange="onTrickCheckBox('check-{{$item->id}}')" type="checkbox" value="" id="check-{{ $item->id }}"
                                        {{ $item->status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="check-{{ $item->id }}">
                                        ເຜິຍແພ່
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Search Box --}}

    <!-- Modal -->
    <div class="modal fade notosanLao" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">ຄົ້ນຫາ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ອອກ</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> ຕົກລົງ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripting')
    <script>
        function onClickItem(id){
            console.log(id);
            var url = "{{route('ThirdPartyInsuranceController.edit',['id'=>':id'])}}";
            url = url.replace(':id',id);
            window.location.replace(url);
        }

        function onTrickCheckBox(id){
            var checkBox = document.getElementById(id);
            if(checkBox.checked){
                console.log("on");
                var url = "{{route('ThirdPartyInsuranceController.updateAvailableStatus',['id'=>':id'])}}";
                url = url.replace(':id',id);
                window.location.replace(url);
            }else{
                console.log('Off');
                var url = "{{route('ThirdPartyInsuranceController.updateNotAvailableStatus',['id'=>':id'])}}";
                url = url.replace(':id',id);
                window.location.replace(url);
            }
        }
    </script>
@endsection