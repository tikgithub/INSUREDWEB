@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3>ສ້າງແຜນ ແລະ ກຳນົດລາຄາຄຸ້ມຄອງ ປະກັນໄພອຸບັດຕິເຫດ</h3>
        </div>
    </div>
    {{-- End Header --}}
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ສ້າງແຜນ ແລະ ກຳນົດລາຄາຄຸ້ມຄອງ ປະກັນໄພອຸບັດຕິເຫດ</li>
        </ol>
    </nav>
    {{-- End Navigator bar --}}
    <hr>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <select name="company_id" class="form-select" id="company_id" onchange="selectionSubmit()">
                <option value="">ເລືອກ</option>
                @foreach ($companies as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @isset($accidentData)
    {{-- Display option for each company --}}
    <div class="row pt-3 notosanLao">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>ປະເພດການຄຸ້ມຄອງ</th>
                    <th>ການເຜິຍແພ່</th>
                    <th class="text-center"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($accidentData as $item)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                @if ($item->status)
                                    <i class="bi bi-check fs-4"></i>
                                @else
                                    <i class="bi bi-x-circle fs-4"></i>
                                @endif
                            </td>
                            <td class="text-center"> 
                                <a href="{{route('AccidentItemController.create',['id'=>$item->id])}}" class=" text-white btn btn-info btn-sm">ຈັດການແຜນ ແລະ ລາຄາ</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endisset
@endsection
@section('scripting')
    <script>
        function selectionSubmit(){
            var getSelectIndex = document.getElementById("company_id");
            //Get selected ID from select
            var selectedCompanyId = getSelectIndex.options[getSelectIndex.selectedIndex].value;
            if(selectedCompanyId==""){
                return;
            }
            //Build the redirect String URL
            var loadURL = "{{route('AccidentPlanController.search',['company_id'=>':id'])}}";
            loadURL = loadURL.replace(':id',selectedCompanyId);
            window.location.href= loadURL;
            
        }
    </script>
@endsection