@extends('layouts.public_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="notosanLao text-center">
                    ເລືອກຮູບແບບປະກັນໄພຍານພາຫະນະ
                </h3>
            </div>
        </div>
        {{-- Show Level detail --}}
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb notosanLao">
          <li class="breadcrumb-item"><a href="{{route('welcome')}}">ໜ້າຫຼັກ</a></li>
          <li class="breadcrumb-item"><a
            href="{{ route('InsuranceFlowController.showInsuranceTypeSelection') }}">ຊື້ປະກັນໄພ</a></li>
          <li class="breadcrumb-item active" aria-current="page">ເລືອກຮູບແບບປະກັນໄພຍານພາຫະນະ</li>
        </ol>
      </nav>
        {{-- Padding --}}
        <div class="pt-3"></div>
        {{-- Show Menu Selection --}}
        <div class="row" style="padding-bottom: 150px;">
            <div class="col-md-6 offset-md-3">
                <div class="card shadow notosanLao">
                    <div class="card-body">
                        <form action="{{route('InsuranceFlowController.vehicleSearchForInsurancePackage')}}" method="get">

                            {{-- Level Selection Container --}}
                            <div class=" mb-3">
                                <label for="level_select" class="form-label fs-4">ເລືອກແບບປະກັນໄພ</label>
                                <select name="level" id="level" class="form-control" onchange="onSelectLevel()">
                                    <option value="">ເລືອກ</option>
                                    @foreach ($levels as $item)
                                        <option class="notosanLao" value="{{ $item->id }}"
                                            menu-type="{{ $item->menu_type }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Third Party Selection Container --}}
                            <div id="thirdPartyContainer" style="display: none">
                                {{-- Vehicle Type --}}
                                <div class="mb-3">
                                    <label for="vehicle_type" class="form-label fs-4">ເລືອກປະເພດຍານພານະຫະ</label>
                                    <select name="vehicle_type" id="vehicle_type" class="form-control" onchange="onSelectVehicleType()">
                                        @foreach ($vehicleTypes as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Vehicle Detail
                                <div class="mb-3">
                                    <label for="vehicle_detail" class="form-label fs-4">ຕົວເລືອກ</label>
                                    <select name="vehicle_detail" id="vehicle_detail" class="form-control" disabled>
                                    </select>
                                </div> --}}

                            </div>
                            {{-- Button Submit --}}
                            <div class="mb-3 text-center" id="btnSubmitContainer">
                                <button type="submit" class="btn btn-lg bg-blue text-white"><i class="bi bi-search"></i> ຄົ້ນຫາ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<div class="">
    @include('layouts.footer')
</div>
@endsection
@section('scripting')
    <script>
        var baseRoute = "{{ env('BASE_ROUTE') }}";

        /* Function to check what user selected */
        function onSelectLevel() {
            var levelSelect = document.getElementById('level');
            var selectMenuType = levelSelect.options[levelSelect.selectedIndex].getAttribute('menu-type');
            var selectMenuId = levelSelect.options[levelSelect.selectedIndex].value;
            var thirdPartyOption = document.getElementById('vehicle_type');

            var thirdPartyContainer = document.getElementById('thirdPartyContainer');
            thirdPartyContainer.style.display = "none";

            console.log(selectMenuType);
            /* Check the select menu type */
            if (selectMenuType === 'THIRD_PARTY') {
                thirdPartyContainer.style.display = "block";
            }
        }
        /* onSelect Vehicle type*/
        function onSelectVehicleType(){
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
            .then(res=>res.json())
            .then(data=>{
                console.log(data);
                if(data.length > 0){
                    vehicleDetailSelect.disabled = false;
                    //Add data to select box
                    for(let i = 0; i < data.length; i++){
                        let option = document.createElement('option');
                        option.value = data[i].id;
                        option.text = data[i].name;
                        vehicleDetailSelect.appendChild(option);
                    }
                }

            })
            .catch(error=>{console.log(error)});
        }
    </script>
@endsection
