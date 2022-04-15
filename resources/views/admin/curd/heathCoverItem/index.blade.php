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
            <li class="breadcrumb-item active" aria-current="page">ຈັດການຂໍ້ມູນລາຍການທີ່ຄຸ້ມຄອງ</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="fs-4">ຄົ້ນຫາ</label>
            <select name="company_id" id="company_id" class="form-select form-select-lg" onchange="onSelectCompany()">
                <option value="">ເລືອກ</option>
                @foreach ($companies as $item)
                    @if(@isset($selected_company_id))
                        <option value="{{ $item->id }}" {{$item->id == $selected_company_id? 'selected':''}}>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                    
                @endforeach
            </select>
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
                <form action="{{route('HeathCoverItemController.Store')}}" method="POST">
                    <div class="modal-body">
                        @csrf
                       <input type="hidden" name="cover_type_id" id="add_cover_type_id">
                       <div class="mb-3">
                           <label for="" class="fs-4">ລາຍການ</label>
                           <input type="text" name="name" id="name" class="form-control form-control-lg">
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

    {{-- display table --}}
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead class="fs-4">
                    <th>#</th>
                    <th>ປະເພດການຄຸ້ມຄອງ</th>
                    <th>ບໍລິສັດປະກັນ</th>
                    <th class="text-center"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($coverTypes as $item)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->company_name}}</td>
                            <td class="text-center" >
                                <a href="{{route('HeathCoverItemController.Create',['cover_type_id'=>$item->id])}}" class="btn btn-success"><i class="bi bi-plus-circle"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripting')
@include('toastrMessage')
    <script>
        function callAddModal(item){
            document.getElementById('add_cover_type_id').value = item.id;
        }
        function onSelectCompany(){
            var selection = document.getElementById('company_id');
            var selectedId = selection.options[selection.selectedIndex].value;
            console.log(selectedId);
            if(selectedId==""){
                var indexURL = "{{route('HeathCoverItemController.Index')}}";
                window.location.href= indexURL;
                return;
            }
            var url = "{{route('HeathCoverItemController.getCoverTypeByCompany',['company_id'=>':company_id'])}}";
            url = url.replace(':company_id',selectedId);

            window.location.href = url;
        }
    </script>
@endsection