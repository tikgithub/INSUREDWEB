@extends('layouts.admin_layout')
@section('content')
<div class="pt-5"></div>
{{-- Navigator bar --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb notosanLao">
        <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('AccidentPlanController.index') }}">ກຳນົດລາຍການ PA/OPA</a></li>
        <li class="breadcrumb-item active" aria-current="page">ຕັ້ງວົງເງິນປະກັນ</li>
    </ol>
</nav>
{{-- End Navigator bar --}}
<hr>

@endsection