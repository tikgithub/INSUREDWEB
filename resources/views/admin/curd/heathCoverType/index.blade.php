@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>ຈັດການຂໍ້ມູນປະເພດການຄຸ້ມຄອງຂອງປະກັນໄພສຸຂະພາບ</h3>
        </div>
    </div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຈັດການຂໍ້ມູນປະເພດການຄຸ້ມຄອງຂອງປະກັນໄພສຸຂະພາບ</li>
        </ol>
    </nav>
    {{-- End Navigator bar --}}
    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <button data-bs-toggle="modal" data-bs-target="#addModal" type="button" class="btn btn-success"><i
                    class="bi bi-plus-circle me-2"></i>ເພີ່ມ</button>
        </div>
    </div>
    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-4" id="addModalLabel">ເພີ່ມຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('HeathCoverController.Store') }}" method="post">
                        @csrf
                        <div class="mb-2">
                            <label for="" class="fs-4">ບໍລິສັດປະກັນໄພ</label>
                            <select name="company_id" id="company_id" required class="form-select form-select-lg">
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="" class="fs-4">ລາຍການທີ່ຄຸ້ມຄອງ</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg" required>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle me-2"></i>ອອກ</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-save me-2"></i>ບັນທຶກ</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>ຊື່</th>
                    <th>ບໍລິສັດ</th>
                    <th>ເຜິຍແຜ່</th>
                    <th class="text-center"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($heathCovers as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->company_name }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status-{{ $item->id }}"
                                        name="status" {{ $item->status == true ? 'checked' : '' }}
                                        onchange="switching('status-{{ $item->id }}')">
                                    <label class="form-check-label" for="status"></label>
                                </div>
                            </td>
                            <td class="text-center">

                                <button onclick="editModal({{ collect($item) }})" data-bs-toggle="modal"
                                    data-bs-target="#editModal" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                <form action="{{ route('HeathCoverController.Update') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="editId" id="editId">
                            <label for="">ບໍລິສັດ</label>
                            <select name="editCompany_id" id="editCompany_id" class="form-select form-select-lg" required>
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">ລາຍການຄຸ້ມຄອງ</label>
                            <input type="text" name="editName" id="editName" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                class="me-2 bi bi-x-circle"></i>ອອກ</button>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-pencil me-2"></i>ຕົກລົງ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripting')
    @include('toastrMessage')
    <script>
        function switching(id) {
            var switcher = document.getElementById(id);
            var route = "{{ route('HeathCoverController.ChangeStatus', ['id' => ':id', 'status' => ':status']) }}";
            route = route.replace(':id', id.split('-')[1]);

            if (switcher.checked) {
                route = route.replace(':status', 1);
            } else {
                route = route.replace(':status', 0);
            }

            window.location.href = route;
        }

        function editModal(obj) {
            document.getElementById('editName').value = obj.name;
            document.getElementById('editId').value = obj.id;
        
            var companies = document.getElementById('editCompany_id');


            for (i = 0; i < companies.options.length; i++) {
                if (companies.options[i].value == obj.company_id) {
                    companies.options[i].setAttribute('selected', true);
                }
            }
        }
    </script>
@endsection
