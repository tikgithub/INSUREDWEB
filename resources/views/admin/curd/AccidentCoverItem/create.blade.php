@extends('layouts.admin_layout')
@section('content')
<div class="pt-5"></div>
{{-- Navigator bar --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb notosanLao">
        <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
        <li class="breadcrumb-item"><a href="{{ URL::previous() }}">ກຳນົດລາຍການ PA/OPA</a></li>
        <li class="breadcrumb-item active" aria-current="page">ກຳນົດລາຍການທີ່ຈະຄຸ້ມຄອງ PA/OPA</li>
    </ol>
</nav>
{{-- End Navigator bar --}}
<hr>

{{-- Header --}}
<div class="row">
    <div class="col-md-12 text-center notosanLao">
        <h3>ກຳນົດລາຍການທີ່ຈະຄຸ້ມຄອງ PA/OPA</h3>
        <img src="{{asset($coverTypeData->companylogo)}}" style="width: auto; height:100px;" alt="" srcset="">
        <h4 class="pt-2">{{$coverTypeData->companyname}} {{$coverTypeData->name}}</h4>
    </div>
</div>

{{-- Display Data --}}

<div class="row notosanLao">
    <div class="col-md-6 offset-md-3">
        <table class="table table-hover">
            <thead>
                <th>#</th>
                <th>ລາຍການທີ່ຄຸ້ມຄອງ</th>
                <th>ລາຄາຄຸ້ມຄອງ</th>
                <th><i class="bi bi-gear"></i></th>
            </thead>
        </table>
    </div>
</div>

@endsection