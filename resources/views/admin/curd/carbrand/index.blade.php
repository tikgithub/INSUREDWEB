@extends('layouts.admin_layout')
@section('content')
{{-- Padding --}}
<div class="pt-5"></div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb notosanLao">
      <li class="breadcrumb-item"><a href="{{route('AdminController.showAdminDashBoard')}}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{route('AdminController.indexDataManager')}}">ຈັດການຂ້ໍມູນ</a></li>
      <li class="breadcrumb-item active" aria-current="page">ຍີ້ຫໍ້ລົດ</li>
    </ol>
  </nav>
  <hr>
  {{-- Body --}}
  <div class="row">
      <div class="col-md-4 offset-md-4 notosanLao">
          {{-- Form Submt--}}
          @include('flashMessage')
          <h4 class="text-center">ເພີ່ມຂໍ້ມູນຍີ່ຫໍ້ລົດ</h4><hr>
            <form action="{{route('AdminController.storeCarbrand')}}" method="post">
                    @csrf
                {{-- Carbrand text --}}
                    <div class="mb-3">
                    <label for="">ຍີ້ຫໍ້ລົດ</label>
                    <input type="text" name="carbrand" id="carbrand" class="form-control {{($errors->has('carbrand'))? 'border-danger':''}}">
                </div>
                {{-- Submit Button --}}
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i> ເພີ່ມ</button>
                </div>
            </form>
          {{-- End Form SUbmit --}}
          <hr>
          {{-- Table display Data --}}
          <table class="table table-hover notosanLao bg-white rounded">
            <thead>
                <th>#</th>
                <th>ຍີ່ຫໍ້ລົດ</th>
                <th class="text-end"><i class="bi bi-gear-fill"></i></th>
            </thead>
            <tbody>
                @foreach ($carbrand as $item)
                    <tr>
                        <td>{{$carbrand->firstItem() + $loop->index}}</td>
                        <td>{{$item->name}}</td>
                        <td class="text-end">
                            <a onclick="onEditClick('{{$item->id}}','{{$item->name}}')" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
          {{$carbrand->links('pagination::bootstrap-5')}}
          {{-- End Table for display data --}}
      </div>
  </div>
  {{-- End Body --}}

  {{-- Modal Edit --}}
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog notosanLao">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">ແກ້ໄຂຂໍ້ມູນຍີ້ຫໍ້ລົດ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('AdminController.updateCarbrand')}}" method="post">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="editId" value="" id="editId">
                <input type="text" name="editName" id="editName" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ອອກ</button>
              <button type="submit" class="btn btn-warning">ແກ້ໄຂ</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  {{-- End Modal Edit --}}
@endsection

{{-- Scripting Section --}}
@section('scripting')
    <script>
        function onEditClick(id, name){
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
        }
    </script>
@endsection