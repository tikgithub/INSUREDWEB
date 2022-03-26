@php
    use App\Models\InsuranceCompany;
@endphp
@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3>ຂໍ້ມູນປະເພດການຄຸ້ມຄອງ PA/OPA</h3>
        </div>
    </div>
    {{-- End Header --}}
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຂໍ້ມູນປະເພດການຄຸ້ມຄອງ PA/OPA</li>
        </ol>
    </nav>
    {{-- End Navigator bar --}}
    <hr>

    {{-- Search Panel --}}
    <div class="row notosanLao">
        <div class="col-md-3 text-center">
            <select  name="search_by_company" id="search_by_company" class="form-select" onchange="onSearchByCompany()">
                <option value="">ທັງໝົດ</option>
                @foreach ($companies as $item)
                    @if(isset($company_id))
                        <option value="{{ $item->id }}" {{$item->id==$company_id? 'selected':''}}>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="bi bi-plus-circle"></i> ເພີ່ມ</button>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    {{-- Table display Panel --}}
    <div class="row notosanLao">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead class="fs-5">
                    <th>#</th>
                    <th>ປະເພດການຄຸ່ມຄອງ</th>
                    <th>ບໍລິສັດ</th>
                    <th>ການເຜີຍແພ່</th>
                    <th><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($heathCoverTypes as $item)
                        <tr>
                            <td>{{ $heathCoverTypes->firstItem() + $loop->index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{InsuranceCompany::find($item->company_id)->name;}}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="statusSwitch"
                                        onchange="onChangeUpdateStatus(this,'{{ $item->id }}');"
                                        {{ $item->status ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <button onclick="onClickEdit({{ $item }})" type="button"
                                    class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"><i
                                        class="bi bi-pencil"></i></button>
                                <button onclick="onClickDelete({{ $item }})" type="button"
                                    class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                        class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $heathCoverTypes->links('pagination::bootstrap-5') }}
        </div>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleAddModal" aria-hidden="true">
        <div class="modal-dialog notosanLao">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleAddModal">ເພີ່ມຂໍ້ມູນປະເພດປະກັນໄພ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('HeathCoverTypeController.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="">ບໍລິສັດປະກັນໄພ</label>
                            <select name="insurance_company" id="insurance_company" class="form-select" required>
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">ປະເພດການຄຸ້ມຄອງ</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i>
                        ອອກ</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> ເພີ່ມ</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Modal --}}
    <div class="modal fade notosanLao" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ແກ້ໄຂຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('HeathCoverTypeController.update') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="editId" id="editId" required>
                        <input type="text" name="editName" id="editName" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                            ອອກ</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-pencil"></i> ແກ້ໄຂ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Delete modal --}}
    <div class="modal fade notosanLao" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">ລຶບຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <p class="fs-4">
                        ທ່ານຕ້ອງການລຶບການດັ້່ງກ່າວແມ່ນບໍ່ ?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                        ອອກ</button>
                    <a id="btnDelete" class="btn btn-danger"><i class="bi bi-trash"></i> ລຶບ</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripting')
    @include('toastrMessage')
    <script>
        function onClickEdit(objs) {
            document.getElementById('editId').value = objs.id;
            document.getElementById('editName').value = objs.name;
        }

        function onClickDelete(objs) {
            var url = '{{ route('HeathCoverTypeController.delete', ['id' => ':id']) }}';
            url = url.replace(':id', objs.id);

            document.getElementById('btnDelete').setAttribute('href', url);
        }

        //Update Type Status
        function onChangeUpdateStatus(e, id) {
            var url = '{{ route('HeathCoverTypeController.updateStatus', ['id' => ':id', 'status' => ':status']) }}';
            url = url.replace(':id', id);
            if (e.checked) {
                url = url.replace(':status', 1);
                window.location.href = url;
            } else {
                url = url.replace(':status', 0);
                window.location.href = url;
            }
        }
        //Search By Company
        function onSearchByCompany(){
          var searchSelect = document.getElementById('search_by_company');
          var searchId = searchSelect.options[searchSelect.selectedIndex].value;
          var url = '{{route('HeathCoverTypeController.searchByCompany',['company_id'=>':company_id'])}}'.replace(':company_id',searchId);
          if(searchId){
              window.location.href= url;
          }
          
        }
    </script>
@endsection
