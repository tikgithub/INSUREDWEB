@extends('layouts.admin_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຂໍ້ມູນປະຍານພະຫະນະ</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}

    <h3 class="notosanLao text-center">ຂໍ້ມູນປະຍານພະຫະນະ</h3>

    {{-- Form submit selection --}}
    <div class="row">
        <div class="col-md-4 offset-md-4">
            @include('flashMessage')
            <form action="{{ route('VehicleTypeController.store') }}" method="post" class="notosanLao">
                @csrf
                <div class="mb-3">
                    <input type="text" placeholder="ປະເພດລົດ" name="name" id="name"
                        class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success"><i class="b bi-save me-2"></i> ເພີ່ມ</button>
                </div>
            </form>
            <hr>
        </div>
    </div>
    {{-- End Form Submit Section --}}

    {{-- Table Display --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <table class="notosanLao table table-hover">
                <thead class="fs-4">
                    <th>#</th>
                    <th>ປະເພດ</th>
                    <th class="text-center">
                        <i class="bi bi-gear"></i>
                    </th>
                </thead>
                <tbody>
                    @foreach ($vehicleTypes as $item)
                        <tr>
                            <td>{{ $vehicleTypes->firstItem() + $loop->index }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">
                                <a data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-warning btn-sm" onclick="onClickEdit({{$item->id}},'{{$item->name}}')"><i
                                        class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $vehicleTypes->links('pagination::bootstrap-5') }}
        </div>
    </div>
    {{-- End Table display --}}
    {{-- Edit Data Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog notosanLao">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ແກ້ໄຂຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('VehicleTypeController.update')}}" method="post">
                    <div class="modal-body">
                       @csrf
                       <input type="hidden" name="editId" id="editId">
                       <input type="text" name="editName" id="editName" class="form-control" autofocus>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ອອກ</button>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-pencil"></i> ບັນທຶກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Edit Data Modal --}}
@endsection
@section('scripting')
    <script>
        function onClickEdit(id, name){
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;

        }
    </script>
@endsection
