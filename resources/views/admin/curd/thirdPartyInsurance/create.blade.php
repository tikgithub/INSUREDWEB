@extends('layouts.admin_layout')
@section('content')
    {{-- Padding Mode --}}
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page"> ສ້າງຮູບແບບປະກັນໄພບຸກຄົນທີສາມ</li>
        </ol>
    </nav>
    <hr>
    <h3 class="notosanLao text-center">ສ້າງຮູບແບບປະກັນໄພບຸກຄົນທີສາມ</h3>

    <div class="row notosanLao">
        <div class="col-md-4 offset-md-4">
            @include('flashMessage')
            <form action="{{route('ThirPartyInsuranceController.store')}}" method="post" class="fs-4">
                @csrf
                {{-- Level --}}
                <div class="mb-3">
                    <label for="" class="form-label">ຊັ້ນປະກັນໄພ</label>
                    <select name="level" id="level"
                        class="form-select form-select-lg {{ $errors->has('level') ? 'border-danger' : '' }}" required>
                        <option value="">ເລືອກ</option>
                        @foreach ($levels as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Insurance Company --}}
                <div class="mb-3">
                    <label for="" class="form-label">ບໍລິສັດປະກັນໄພ</label>
                    <select name="company" id="company"
                        class="form-select form-select-lg {{ $errors->has('company') ? 'border-danger' : '' }}" required>
                        <option value="">ເລືອກ</option>
                        @foreach ($companies as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Name Of Package --}}
                <div class="mb-3">
                    <label for="" class="form-lable">ຊື່ຮູບແບບປະກັນໄພ</label>
                    <input type="text" name="name" id="name"
                        class="form-control form-control-lg {{ $errors->has('name') ? 'border-danger' : '' }}" required>
                </div>


                {{-- Vehicle Type --}}

                <div class="mb-3">
                    <label for="" class="form-label">ປະເພດຍານພາຫະນະ</label>
                    <hr>
                    <select name="vehicle_type" id="vehicle_type" class="form-select form-select-lg"
                        onchange="onSelectVehicleType()" required>
                        <option value="">ເລືອກ</option>
                        @foreach ($vehicleTypes as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    {{-- Vehicle Detail --}}
                    <div class="mb-3">
                        <label for="vehicle_detail" class="form-label fs-4">ຕົວເລືອກ</label>
                        <select name="vehicle_detail" id="vehicle_detail"
                            class="form-select form-select-lg {{ $errors->has('vehicle_detail') ? 'border-danger' : '' }}"
                            required disabled>
                        </select>
                    </div>

                    {{-- Fee --}}
                    <div class="mb-3">
                        <label for="" class="form-label">ຄ່າທຳນຽມ</label>
                        <input type="number" name="fee" id="fee"
                            class="form-control form-control-lg {{ $errors->has('fee') ? 'border-danger' : '' }}"
                            required>
                    </div>

                    {{-- Final Price --}}
                    <div class="mb-3">
                        <label for="" class="form-label">ລາຄາຂາຍ</label>
                        <input type="number" name="final_price" id="final_price"
                            class="form-control form-control-lg {{ $errors->has('final_price') ? 'border-danger' : '' }}" required>
                    </div>

                    {{-- Term and Condition --}}
                    <div class="mb-3">
                        <label for="" class="form-label">ເງືອນໄຂການໃຊ້ບໍລິການ</label>
                        <textarea name="term" id="term"
                            class="form-control {{ $errors->has('term') ? 'border-danger' : '' }}" rows="10"
                            required></textarea>
                    </div>

                    {{-- Report Path --}}
                    <div class="mb-3">
                        <label for="" class="form-lable">Report Path</label>
                        <input type="text" name="report_path" id="report_path" class="form-control">
                    </div>

                    {{-- Save Button --}}
                    <div class="mb-3 text-center d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save"></i> ເພີ່ມ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripting')
    <script>
        var baseRoute = "{{ env('BASE_ROUTE') }}";
        /* onSelect Vehicle type*/
        function onSelectVehicleType() {
            var vehicleTypeSelect = document.getElementById('vehicle_type');
            var vehicleDetailSelect = document.getElementById('vehicle_detail');
            vehicleDetailSelect.innerHTML = "";
            vehicleDetailSelect.disabled = true;
            //Get select id
            var vehicleTypeSelectId = vehicleTypeSelect.options[vehicleTypeSelect.selectedIndex].value;
            console.log("VehicleType ID = " + vehicleTypeSelectId);
            //Get Vehicle Detail selection
            var vehicleDetailSelection = document.getElementById("vehicle_detail");
            //Get data from JSON
            fetch(window.location.origin + baseRoute + '/api/json/vehicledetail/' + vehicleTypeSelectId)
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data.length > 0) {
                        vehicleDetailSelect.disabled = false;
                        //Add data to select box
                        for (let i = 0; i < data.length; i++) {
                            let option = document.createElement('option');
                            option.value = data[i].id;
                            option.text = data[i].name;
                            vehicleDetailSelect.appendChild(option);
                        }
                    }

                })
                .catch(error => {
                    console.log(error)
                });
        }
    </script>
@endsection
