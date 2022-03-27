@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AccidentItemController@index') }}">ກຳນົດລາຍການ PA/OPA</a></li>
            <li class="breadcrumb-item active" aria-current="page">ກຳນົດລາຍການທີ່ຈະຄຸ້ມຄອງ PA/OPA</li>
        </ol>
    </nav>
    {{-- End Navigator bar --}}
    <hr>

    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <img src="{{ asset($coverTypeData->companylogo) }}" style="width: auto; height:100px;" alt="" srcset="">
            <h4 class="pt-2">{{ $coverTypeData->companyname }} {{ $coverTypeData->name }}</h4>
        </div>
    </div>

    {{-- Create Button --}}
    <div class="row notosanLao">
        <div class="col-md-6 offset-md-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="bi bi-plus-circle me-2"></i> ເພີ່ມ</button>
        </div>
    </div>

    {{-- Display Data --}}
    <div class="row notosanLao">
        <div class="col-md-6 offset-md-3">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>ລາຍການທີ່ຄຸ້ມຄອງ</th>
                    <th><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($coverItems as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->item }}</td>
                            <td>
                                <a onclick="onClickEdit({{$item->id}},'{{$item->item}}')" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <a href="{{route('AccidentItemController.delete',['id'=>$item->id])}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade notosanLao" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">ເພີ່ມຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('AccidentItemController.store')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="cover_type_id" value="{{ $coverTypeData->id }}">
                            <label for="">ລາຍການຄຸ້ມຄອງ</label>
                            <input type="text" name="cover_item" id="cover_item" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="bi bi-x-circle"></i> ອອກ</button>
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
                    <h5 class="modal-title" id="editModalLabel">ແກ້ໄຂມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('AccidentItemController.update')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="update_id" id="update_id">
                            <label for="">ລາຍການຄຸ້ມຄອງ</label>
                            <input type="text" name="editItem" id="editItem" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="bi bi-x-circle"></i> ອອກ</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> ແກ້ໄຂ</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripting')
    @include('toastrMessage')
    <script>
        function onClickEdit(update_id, name){
            document.getElementById("update_id").value = update_id;
            document.getElementById("editItem").value = name;
        }
    </script>
@endsection
