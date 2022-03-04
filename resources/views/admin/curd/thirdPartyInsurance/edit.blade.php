@php
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
            <li class="breadcrumb-item"><a
                    href="{{ route('ThirdPartyInsuranceController.index') }}">ກຳນົດຮູບແບບປະກັນໄພບຸກຄົນທີ 3</a></li>
            <li class="breadcrumb-item active" aria-current="page"> ແກ້ໄຂຮູບແບບປະກັນໄພບຸກຄົນທີ 3</li>
        </ol>
    </nav>
    <hr>
    <h3 class="notosanLao text-center">ແກ້ໄຂຮູບແບບປະກັນໄພບຸກຄົນທີ 3 ({{$package->name}})</h3>
    <div class="row">
        <div class="col-md-12 d-fex justify-content-center">
            <div class="pt-5"></div>
            <div class="loader" id="loader"></div>
        </div>
    </div>

    <div class="container" id="formPanel">
        <div class="row">
            <div class="col-md-12">
                @include('flashMessage')
            </div>
        </div>
        <div class="row notosanLao">
            <div class="col-md-4">
                <form action="{{ route('ThirdPartyInsuranceController.update') }}" method="post" class="">
                    <input type="hidden" name="editId" value="{{ $package->id }}">
                    @csrf
                    {{-- Level --}}
                    <div class="mb-3">
                        <label for="" class="form-label">ຊັ້ນປະກັນໄພ</label>
                        <select name="level" id="level"
                            class="form-select  {{ $errors->has('level') ? 'border-danger' : '' }}" required>
                            @foreach ($levels as $item)
                                <option value="{{ $item->id }}" {{ $package->level == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Insurance Company --}}
                    <div class="mb-3">
                        <label for="" class="form-label">ບໍລິສັດປະກັນໄພ</label>
                        <select name="company" id="company"
                            class="form-select  {{ $errors->has('company') ? 'border-danger' : '' }}" required>
                            @foreach ($companies as $item)
                                <option value="{{ $item->id }}"
                                    {{ $package->company_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Name Of Package --}}
                    <div class="mb-3">
                        <label for="" class="form-lable">ຊື່ຮູບແບບປະກັນໄພ</label>
                        <input type="text" name="name" id="name" value="{{ $package->name }}"
                            class="form-control  {{ $errors->has('name') ? 'border-danger' : '' }}" required>
                    </div>

                    {{-- Vehicle Type --}}
                    <div class="mb-3">
                        <label for="" class="form-label">ປະເພດຍານພາຫະນະ</label>
                        <select name="vehicle_type" id="vehicle_type" class="form-select "
                            onchange="onSelectVehicleType()" required>
                            @foreach ($vehicleTypes as $item)
                                <option value="{{ $item->id }}"
                                    {{ $vehicleTypeIDFromPackage == $item->id ? 'selected' : '' }}> {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Vehicle Detail --}}
                    <div class="mb-3">
                        <label for="vehicle_detail" class="form-label ">ຕົວເລືອກ</label>
                        <select name="vehicle_detail" id="vehicle_detail"
                            class="form-select  {{ $errors->has('vehicle_detail') ? 'border-danger' : '' }}" required
                            disabled>
                        </select>
                    </div>

                    {{-- Fee --}}
                    <div class="mb-3">
                        <label for="" class="form-label">ຄ່າທຳນຽມ</label>
                        <input type="number" name="fee" id="fee" value="{{ $package->fee }}"
                            class="form-control  {{ $errors->has('fee') ? 'border-danger' : '' }}" required>
                    </div>

                    {{-- Final Price --}}
                    <div class="mb-3">
                        <label for="" class="form-label">ລາຄາຂາຍ</label>
                        <input type="number" name="final_price" id="final_price" value="{{ $package->final_price }}"
                            class="form-control  {{ $errors->has('final_price') ? 'border-danger' : '' }}" required>
                    </div>

                    {{-- Term and Condition --}}
                    <div class="mb-3">
                        <label for="" class="form-label">ເງືອນໄຂການໃຊ້ບໍລິການ</label>
                        <textarea name="term" id="term"
                            class="form-control {{ $errors->has('term') ? 'border-danger' : '' }}" rows="5"
                            required>{{ $package->term }}</textarea>
                    </div>

                    {{-- Save Button --}}
                    <div class="mb-3 text-center d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i> ເພີ່ມ</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h5>ລາຍການທີ່ຄຸ້ມຄອງ <button data-bs-toggle="modal" data-bs-target="#addModal"
                        class="ms-3 btn btn-success btn-sm"><i class="bi bi-plus"></i> ເພີ່ມ</button></h5>
                <hr>
                <table class="table table-sm table-hover">
                    <thead>
                        <th>ລຳດັບ</th>
                        <th>ລາຍການ</th>
                        <th>ລາຄາ</th>
                        <th class="">
                            <i class="bi bi-gear"></i>
                        </th>

                    </thead>
                    <tbody>
                        @foreach ($coverItems as $item)
                            <tr>
                                <td>{{$item->item_order}}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->price, 0) }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" onclick="openEditModal({{$item->id}},'{{$item->name}}',{{$item->price}},{{$item->item_order}})" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil"></i></a>
                                    <a href="{{route('ThirdPartyCoverController.destroy',['id'=>$item->id])}}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add Third Party Modal --}}
    <div class="modal fade notosanLao" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">ເພີ່ມຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('ThirPartyCoverController.store')}}" method="post">
                    <div class="modal-body">
                       @csrf
                       <input type="hidden" name="third_package_id" value="{{$package->id}}">
                       <div class="mb-3">
                           <label for="" class="form-label">ລາຍການ</label>
                           <input type="text" name="addName" id="name" class="form-control">
                       </div>
                       <div class="mb-3">
                           <label for="">ວົງເງິນຄຸ້ມຄອງ</label>
                           <input type="number" name="addPrice" id="price" class="form-control">
                       </div>
                       <div class="mb-3">
                           <label for="">ລຳດັບການສະແດງຜົນ</label>
                           <input type="number" name="item_order" id="item_order" class="form-control text-center" min="1" max="{{sizeof($coverItems)+1}}" value="{{sizeof($coverItems)+1}}">
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ອອກ</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> ບັນທຶກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        {{-- Edit Third Party Modal --}}
        <div class="modal fade notosanLao" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">ແກ້ໄຂຂໍ້ມູນ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('ThirdPartyCoverController.update')}}" method="post">
                        <div class="modal-body">
                           @csrf

                           <input type="hidden" name="editId" id="editId">
                           <div class="mb-3">
                               <label for="" class="form-label">ລາຍການ</label>
                               <input type="text" name="editName" id="editName" class="form-control">
                           </div>
                           <div class="mb-3">
                               <label for="">ວົງເງິນຄຸ້ມຄອງ</label>
                               <input type="number" name="editPrice" id="editPrice" class="form-control">
                           </div>
                           <div class="mb-3">
                            <label for="">ລຳດັບການສະແດງຜົນ</label>
                            <input type="number" name="edit_item_order" min="1" max="{{sizeof($coverItems)+1}}" id="edit_item_order" class="form-control text-center">
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ອອກ</button>
                            <button type="submit" class="btn btn-warning"><i class="bi bi-pencil"></i> ແກ້ໄຂ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection

@section('scripting')
    <script>
        document.onreadystatechange = () => {
            if (document.readyState === 'complete') {
                var vehicleTypeSelect = document.getElementById('vehicle_type');
                vehicleTypeSelect.selectedIndex = 0;
                onSelectVehicleType();
            }
        };

        function openEditModal(id, name, price, item_order){
            document.getElementById('editName').value = name;
            document.getElementById('editId').value = id;
            document.getElementById('editPrice').value = price;
            document.getElementById('edit_item_order').value = item_order;
        }

        var baseRoute = "{{ env('BASE_ROUTE') }}";
        /* onSelect Vehicle type*/
        function onSelectVehicleType() {
            var formPanel = document.getElementById('formPanel');
            formPanel.style.display = 'none';
            var loader = document.getElementById('loader');
            loader.style.display = 'block';

            var vehicleTypeSelect = document.getElementById('vehicle_type');
            var vehicleDetailSelect = document.getElementById('vehicle_detail');
            vehicleDetailSelect.innerHTML = "";
            vehicleDetailSelect.disabled = true;
            //Get select id
            var vehicleTypeSelectId = vehicleTypeSelect.options[vehicleTypeSelect.selectedIndex].value;
            //Get Vehicle Detail selection
            var vehicleDetailSelection = document.getElementById("vehicle_detail");
            //Get data from JSON
            fetch(window.location.origin + baseRoute + '/api/json/vehicledetail/' + vehicleTypeSelectId)
                .then(res => res.json())
                .then(data => {

                    if (data.length > 0) {
                        vehicleDetailSelect.disabled = false;
                        //Add data to select box
                        for (let i = 0; i < data.length; i++) {
                            let option = document.createElement('option');
                            if (data[i].id == {{ $package->vehicle_detail }}) {
                                option.setAttribute('selected', true);
                            };
                            option.value = data[i].id;
                            option.text = data[i].name;
                            vehicleDetailSelect.appendChild(option);
                        }
                    }
                    formPanel.style.display = 'block';
                    loader.style.display = 'none';
                })
                .catch(error => {
                    console.log(error)
                    formPanel.style.display = 'none';
                    loader.style.display = 'none';
                });
        }
    </script>
@endsection
