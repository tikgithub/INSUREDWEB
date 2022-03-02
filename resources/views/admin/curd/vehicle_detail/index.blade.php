@extends('layouts.admin_layout')
@section('content')
    {{-- Padding Mode --}}
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page"> ຕົວເລືອກປະເພດລົດ</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}
    <h3 class="notosanLao text-center"> ຕົວເລືອກປະເພດລົດ</h3>

    {{-- Form Section --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">
            {{-- Flash Message Alert --}}
            @include('flashMessage')
            <form action="{{route('VehicleDetailController.store')}}" method="post" class="p-3 border notosanLao fs-5" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label for="v_id">ປະເພດຍານພາຫະນະ</label>
                    <select name="v_id" id="v_id" class="form-select form-select-lg" required>
                        <option value="">ເລືອກ</option>
                        @foreach ($vehicleTypes as $item)
                            <option value="{{ $item->id }}" {{(old('v_id')==$item->id)? 'selected':''}}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="name" id="name" placeholder="ຕົວເລືອກ" class="form-control form-control-lg {{($errors->has('name'))? 'border-danger':''}}" required>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> ເພີ່ມຂໍ້ມູນ</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Form Section --}}
    <hr>
    {{-- Table display --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-2 notosanLao">
                <select class="form-select form-select-lg" name="search" id="search" onchange="onChangeVehicleType()">
                    <option value="">ເລືອກ</option>
                        @foreach ($vehicleTypes as $item)
                            <option value="{{ $item->id }}" {{(old('v_id')==$item->id)? 'selected':''}}>{{ $item->name }}</option>
                        @endforeach
                </select>
            </div>
            <table class="table table-sm table-hover notosanLao" id="tableDisplay">
                <thead>
                    <th>#</th>
                    <th>ລາຍການ</th>
                    <th>
                        <i class="bi bi-gear"></i>
                    </th>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
    {{-- End Table display --}}
@endsection
@section('scripting')
   <script>
       function onChangeVehicleType(){
           var selectVeType = document.getElementById('search');
           var selectID = selectVeType.options[selectVeType.selectedIndex].value;
           window.href = "{{route('VehicleDetailController.searchByType')}}";
       }
   </script>
@endsection
