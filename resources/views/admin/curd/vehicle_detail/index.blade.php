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
            <form action="{{ route('VehicleDetailController.store') }}" method="post" class="p-3 border notosanLao fs-5"
                autocomplete="off">
                @csrf
                <div class="mb-3">
                    <label for="v_id">ປະເພດຍານພາຫະນະ</label>
                    <select name="v_id" id="v_id" class="form-select form-select-lg" required>
                        <option value="">ເລືອກ</option>
                        @foreach ($vehicleTypes as $item)
                            <option value="{{ $item->id }}" {{ old('v_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="name" id="name" placeholder="ຕົວເລືອກ"
                        class="form-control form-control-lg {{ $errors->has('name') ? 'border-danger' : '' }}" required>
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
                        <option value="{{ $item->id }}"
                            @isset($selected_v_id) {{ $selected_v_id == $item->id ? 'selected' : '' }} @endisset>
                            {{ $item->name }}</option>
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
                    @isset($vehicleDetails)
                        @foreach ($vehicleDetails as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a onclick="onClickEdit({{$item->id}},'{{$item->name}}')" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal"><i class="b bi-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
    {{-- End Table display --}}

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog notosanLao">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">ແກ້ໄຂຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('VehicleDetailController.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="editId" id="editId">
                        <input type="text" name="editName" id="editName" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ອອກ</button>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-pencil"></i> ແກ້ໄຂ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripting')
    <script>
        function onChangeVehicleType() {
            var selectVeType = document.getElementById('search');
            var selectID = selectVeType.options[selectVeType.selectedIndex].value;
            var redirectUrl = "{{ route('VehicleDetailController.searchByType', ['type_id' => ':type_id']) }}";
            redirectUrl = redirectUrl.replace(':type_id', selectID);
            window.location.replace(redirectUrl);
        }

        function onClickEdit(id,name){
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
        }
    </script>
@endsection
