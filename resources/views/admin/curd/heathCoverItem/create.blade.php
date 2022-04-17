@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>ຈັດການຂໍ້ມູນລາຍການທີ່ຄຸ້ມຄອງ</h3>
        </div>
    </div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('HeathCoverItemController.Index') }}">ປະເພດການຄຸ້ມຄອງ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຈັດການຂໍ້ມູນລາຍການທີ່ຄຸ້ມຄອງ
                ({{ $headerTitleData->cover_name }})</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}

    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset($headerTitleData->logo) }}" alt="{{ $headerTitleData->company_name }}"
                class="company_logo rounded mb-2">
            <h3>{{ $headerTitleData->cover_name }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <button onclick="onClickAdd('{{ $headerTitleData->id }}')" data-bs-toggle="modal" data-bs-target="#addModal"
                type="button" class="btn btn-success"><i class="bi bi-plus-circle me-2"></i>ເພີ່ມ</button>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col-md-6 offset-md-3">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>ລາຍການ</th>
                    <th class="text-center"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">
                                <button onclick="onEditModal({{ collect($item) }})" data-bs-toggle="modal"
                                    data-bs-target="#editModal" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil me-2"></i>ແກ້ໄຂ</button>
                                <button onclick="onDeleteModal({{collect($item)}})" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">ເພີ່ມຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('HeathCoverItemController.Store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="cover_type_id" id="add_cover_type_id">
                        <div class="mb-3">
                            <label for="" class="fs-4">ລາຍການ</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg">
                        </div>
                    <div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                class="me-2 bi bi-x-circle"></i>ອອກ</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save me-2"></i>ຕົກລົງ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ແກ້ໄຂຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('HeathCoverItemController.Update') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-3">
                            <label for="" class="fs-4">ລາຍການ</label>
                            <input type="text" name="name" id="editName" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                class="me-2 bi bi-x-circle"></i>ອອກ</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save me-2"></i>ຕົກລົງ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">ລຶບຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center">ຕ້ອງການລຶບລາຍການນີ້ແມ່ນບໍ່ ?</h2>
                    <div class="mb-3">
                        <label for="" class="fs-4">ລາຍການ</label>
                        <input readonly type="text" name="deleteName" id="deleteName" class="form-control form-control-lg">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i
                            class="me-2 bi bi-x-circle"></i>ອອກ</button>
                    <a id="deleteLink" href="#" class="btn btn-danger"><i class="bi bi-trash me-2"></i>ລຶບ</a>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripting')
    @include('toastrMessage')
    <script>
        function onClickAdd(id) {
            document.getElementById('add_cover_type_id').value = id;
        }

        function onEditModal(item) {
            document.getElementById('editId').value = item.id;
            document.getElementById('editName').value = item.name;
        }
        function onDeleteModal(item){
            document.getElementById('deleteName').value = item.name;
            var delURL = "{{route('HeathCoverItemController.Delete',['id'=>':id'])}}";
            delURL = delURL.replace(':id',item.id);
            var deleteBtn = document.getElementById('deleteLink');
            deleteBtn.href = delURL;
        }
    </script>
@endsection
@section('styles')
    <style>
        .company_logo {
            width: auto;
            height: 100px;
        }

    </style>
@endsection
