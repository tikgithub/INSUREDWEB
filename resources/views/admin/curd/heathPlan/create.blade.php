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
            <li class="breadcrumb-item active" aria-current="page">ແຜນ ແລະ ລາຄາຄຸ້ມຄອງ
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

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <button onclick="onAddModalClick('{{ $headerTitleData->id }}')" type="button" data-bs-toggle="modal"
                data-bs-target="#addModal" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i>ເພີ່ມ</button>
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
                <form action="{{ route('HeathPlanController.Store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="cover_type_id" id="add_cover_type_id">
                        <div class="mb-3">
                            <label for="" class="fs-4">ແຜນ</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="" class="fs-4">ລາຄາຂາຍ</label>
                            <input type="number" name="sale_price" id="sale_price" class="form-control-lg form-control">    
                        </div>
                        <div class="mb-3">
                            <label for="" class="fs-4">ຄາທຳນຽມ</label>
                            <input type="number" name="fee" id="fee" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="" class="fs-4">ຊ່ວງອາຍຸເລີ່ມຕົ້ນ</label>
                            <input type="number" name="start_age" id="start_age" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="" class="fs-4">ຊ່ວງອາຍຸສິນສຸດ</label>
                            <input type="number" name="end_age" id="end_age" class="form-control form-control-lg">
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
                <form action="{{ route('HeathPlanController.Update') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-3">
                            <label for="" class="fs-4">ແຜນ</label>
                            <input type="text" name="name" id="editName" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="" class="fs-4">ລາຄາຂາຍ</label>
                            <input type="number" name="sale_price" id="editSalePrice" class="form-control-lg form-control">    
                        </div>
                        <div class="mb-3">
                            <label for="" class="fs-4">ຄາທຳນຽມ</label>
                            <input type="number" name="fee" id="editFee" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="" class="fs-4">ຊ່ວງອາຍຸເລີ່ມຕົ້ນ</label>
                            <input type="number" name="start_age" id="editStartAge" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="" class="fs-4">ຊ່ວງອາຍຸສິນສຸດ</label>
                            <input type="number" name="end_age" id="editEndAge" class="form-control form-control-lg">
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

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>ແຜນ</th>
                    <th class="text-center"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($plans as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">
                                <button onclick="onEditModalClick({{collect($item)}})" class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal"
                                    data-bs-target="#editModal"><i class="bi bi-pencil me-2"></i>ແກ້ໄຂ</button>
                                <a href="{{route('HeathPlanDetailController.Index',['plan_id'=>$item->id])}}" class="btn btn-sm btn-info"><i
                                        class="bi bi-cash me-2"></i>ວົງເງິນຄຸ້ມຄອງ</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .company_logo {
            width: auto;
            height: 100px;
        }

    </style>
@endsection

@section('scripting')
    @include('toastrMessage')
    <script>
        function onAddModalClick(cover_type_id) {
            document.getElementById('add_cover_type_id').value = cover_type_id;
        }

        function onEditModalClick(item) {
            console.log(item);
            document.getElementById('editId').value = item.id;
            document.getElementById('editName').value = item.name;
            document.getElementById('editSalePrice').value = item.sale_price;
            document.getElementById('editFee').value = item.fee;
            document.getElementById('editStartAge').value = item.start_age;
            document.getElementById('editEndAge').value = item.end_age;
        
        }
    </script>
@endsection
