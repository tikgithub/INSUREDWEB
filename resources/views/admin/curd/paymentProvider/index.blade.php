@extends('layouts.admin_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຂໍ້ມູນຊ່ອງທາງການຈ່າຍເງິນ</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}
    <h3 class="notosanLao text-center">ຂໍ້ມູນຊ່ອງທາງການຈ່າຍເງິນ</h3>

    {{-- Body --}}
    <div class="row">
        <div class="col-md-4 offset-md-4 notosanLao">
            @include('flashMessage')
            <form action="{{ route('LevelController.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" id="name"
                        class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" placeholder="ຊັ້ນປະກັນໄພ">
                </div>
                <div class="mb-1">
                    <select name="menu_type" id="menu_type"
                        class="form-select {{ $errors->has('menu_type') ? 'border-danger' : '' }}">
                        <option value="NORMAL">ປະກັນໄພລົດທົ່ວໄປ</option>
                        <option value="THIRD_PARTY">ປະກັນໄພລົດຕໍ່ບຸກຄົນທີ 3</option>
                    </select>
                </div>
                <div class="mb-1 text-center">
                    <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> ເພີ່ມ</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Table data --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <hr>
            <table class="table table-sm table-hover notosanLao">
                <thead>
                    <th>#</th>
                    <th>ລາຍການ</th>
                    <th>Menu Type</th>
                    <th><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>

                </tbody>
            </table>
           
        </div>
    </div>
    {{-- End Body --}}

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog notosanLao">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ແກ້ໄຂຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('LevelController.update')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="editId" name="editId">
                        <div class="mb-3">
                            <input type="text" name="editName" id="editName" class="form-control"
                                placeholder="ຊັ້ນປະກັນໄພ">

                        </div>
                        <div class="mb-1">
                            <select name="editMenuType" id="editMenuType" class="form-select ">
                                <option value="NORMAL">ປະກັນໄພລົດທົ່ວໄປ</option>
                                <option value="THIRD_PARTY">ປະກັນໄພລົດຕໍ່ບຸກຄົນທີ 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ອອກ</button>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-pencil"></i> ແກ້ໄຂ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Edit --}}
@endsection

@section('scripting')
    <script>
        function callEditModal(id, name, menu_type) {
            document.getElementById('editName').value = name;
            document.getElementById('editId').value = id;

            var menu_typeSelect = document.getElementById('editMenuType');
            var options = menu_typeSelect.options;
            for(let i = 0; i<options.length;i++){

                if(options[i].value == menu_type){
                    options[i].selected = true;
                }
            }
        }
    </script>
@endsection
