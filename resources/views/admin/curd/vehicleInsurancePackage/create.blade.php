@extends('layouts.admin_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ສ້າງຮູບແບບປະກັນໄພອັນໃໝ່</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}
    <h3 class="notosanLao text-center">ສ້າງຮູບແບບປະກັນໄພອັນໃໝ່</h3>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            @include('flashMessage')
        </div>
    </div>
    <div class="row p-5">
        <form action="{{route('VehiclePacakgeController.store')}}" method="post">
            @csrf
            <div class="col-md-12 notosanLao">
              <div class="row g-3">
                  <div class="col-md-2">
                      <label for="" class="form-label">ເລືອກຊັ້ນປະກັນໄພ</label>
                      <select name="level" id="level" class="form-select {{($errors->has('level')? 'border-danger':'')}}" onchange="onSelectLevel()">
                          <option value="">ເລືອກ</option>
                          @foreach ($levels as $item)
                              <option value="{{ $item->id }}" menu_type="{{ $item->menu_type }}">{{ $item->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col-md-3" id="thirdPartyContainer" style="display: none">
                      {{-- Vehicle Type --}}
                      <div class="">
                          <label for="vehicle_type" class="form-label">ເລືອກປະເພດຍານພານະຫະ</label>
                          <select name="vehicle_type" id="vehicle_type" class="form-control">
                              @foreach ($vehicleTypes as $item)
                                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-md-3">
                      <label for="" class="form-label">ຊື່ຮູບແບບປະກັນໄພ</label>
                      <input type="text" name="name" id="name" class="form-control">
                  </div>
                  <div class="col-md-3">
                      <label for="" class="form-label">ບໍລິສັດທີ່ຮັອງຮັບ</label>
                      <select name="c_id" id="c_id" class="form-select">
                          <option value="">ເລືອກ</option>
                          @foreach ($companies as $item)
                              <option value="{{ $item->id }}">{{ $item->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

              </div>
              <div class="row g-3 pt-4">
                  <div class="col-md-2">
                      <label for="" class="form-label">ເງືອນໄຂເລີ່ມຕົ້ນ</label>
                      <input type="text" name="start_rank" id="start_rank" class="form-control">
                  </div>
                  <div class="col-md-2">
                      <label for="" class="form-label">ເງືອນໄຂສິ້ນສຸດ</label>
                      <input type="text" name="end_rank" id="end_rank" class="form-control">
                  </div>
              </div>
              <div class="row g-3 pt-4">
                  <div class="col-md-12">
                      <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> ເພີ່ມ</button>
                  </div>
              </div>
          </div>
      </form>
    </div>
@endsection
{{-- Styling --}}
@section('styles')
    <style>
    </style>
@endsection
{{-- End Stying --}}

{{-- Scripting --}}
@section('scripting')
    <script>
        function onSelectLevel() {
            var levelSelect = document.getElementById('level');
            var selectLevelId = levelSelect.options[levelSelect.selectedIndex].value;
            var menu_type_selected = levelSelect.options[levelSelect.selectedIndex].getAttribute('menu_type');
            var thirdPartyContainer = document.getElementById('thirdPartyContainer');
            thirdPartyContainer.style.display= 'none';
            console.log(menu_type_selected);

            if (menu_type_selected == 'THIRD_PARTY') {
                thirdPartyContainer.style.display = 'block';
            }
        }
    </script>
@endsection
