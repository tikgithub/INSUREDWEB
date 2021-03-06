@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AccidentItemController@index') }}">ປະເພດການຄຸ້ມຄອງ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ແຜນ ແລະ ວົງເງິນຄຸ້ມຄອງ</li>
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

    

    {{-- Input Data --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <button type="button" data-bs-toggle="modal" data-bs-target="#addPlanModal" class="btn btn-success"><i
                    class="bi bi-plus-circle me-2"></i>ເພີ່ມ</button>
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
                                <a onclick="edit({{$item}})" data-bs-toggle="modal" data-bs-target="#editPlanModal" class="btn btn-sm btn-warning"><i
                                        class="bi bi-pencil"></i></a>
                                <a onclick="deletePlan({{$item->id}})" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletePlanModal"><i class="bi bi-trash"></i></a>
                                <a href="{{route('AccidentPlanController.showPlanDetail',['plan_id'=>$item->id])}}" class="btn btn-sm btn-info"><i class="bi bi-info-circle"></i> ວົງເງິນປະກັນ</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Plan Modal --}}
    <div class="modal fade" id="addPlanModal" tabindex="-1" aria-labelledby="addPlanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlanModalLabel">ເພີ່ມຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('AccidentPlanController.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="cover_type_id" value="{{ $coverTypeData->id }}">
                        <div class="mb-3">
                            <label for="">ແຜນ</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">ເລີ່ມຕົ້ນອາຍຸ</label>
                            <input type="number" name="start_age" id="start_age" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">ອາຍຸສູງສຸດ</label>
                            <input type="number" name="end_age" id="end_age" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">ຄ່າທຳນຽມ</label>
                            <input type="number" name="fee" id="fee" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">ລາຄາຂາຍ</label>
                            <input type="number" name="sale_price" id="sale_price" class="form-control">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="bi bi-x-circle"></i> ອອກ</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-plush-circle"></i> ບັນທຶກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Modal --}}
    <div class="modal fade" id="editPlanModal" tabindex="-1" aria-labelledby="editPlanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPlanModalLabel">ແກ້ໄຂຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('AccidentPlanController.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="editId" id="editId">
                        <div class="mb-3">
                            <label for="">ແຜນ</label>
                            <input type="text" name="editName" id="editName" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">ເລີ່ມຕົ້ນອາຍຸ</label>
                            <input type="number" name="editStartAge" id="editStartAge" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">ອາຍຸສູງສຸດ</label>
                            <input type="number" name="editEndAge" id="editEndAge" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">ຄ່າທຳນຽມ</label>
                            <input type="number" name="editFee" id="editFee" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">ລາຄາຂາຍ</label>
                            <input type="number" name="editSalePrice" id="editSalePrice" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="bi bi-x-circle"></i> ອອກ</button>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-pencil"></i> ແກ້ໄຂ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Delete Modal --}}
    <div class="modal fade" id="deletePlanModal" tabindex="-1" aria-labelledby="deletePlanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deletePlanModalLabel">ຢືນຢັນລຶບຂໍ້ມູນ</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ທ່ານຕ້ອງການລຶບຂໍ້ມູນ ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> ອອກ</button>
              <a id="deleteButton" class="btn btn-danger"><i class="bi bi-trash"></i> ລຶບ</a>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('scripting')
@include('toastrMessage')
    <script>
        function edit(item){
            document.getElementById('editId').value = item.id;
            document.getElementById('editName').value = item.name;
            document.getElementById('editStartAge').value = item.start_age;
            document.getElementById('editEndAge').value = item.end_age;
            document.getElementById('editFee').value = item.fee;
            document.getElementById('editSalePrice').value = item.sale_price;
        }
        function deletePlan(id){
            var delBtn = document.getElementById("deleteButton");
            var url = "{{route('AccidentPlanController.delete',['id'=>':id'])}}".replace(':id',id);
            delBtn.href = url;
        }
    </script>
@endsection

