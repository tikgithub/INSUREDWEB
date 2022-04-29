@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center fw-bold">ຂໍ້ຄວາມຈາກ {{ $message->name }}</h3>
        </div>
    </div>
    {{-- Navigation --}}
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showNewAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('MessageToUsController.ViewMessage') }}">ກ່ອງຂໍ້ຄວາມ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inbox</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col-md-4 fs-5">
            <div class="mb-3">
                <u>ຂໍ້ມູນຜູ້ສົ່ງຂໍ້ຄວາມ:</u>
            </div>
            <div class="mb-1 row">
                <label for="" class="col-sm-3 text-end">ຊື່</label>
                <div class="col-sm-9">
                    {{ $message->name }}
                </div>
            </div>
            <div class="mb-1 row">
                <label for="" class="col-sm-3 text-end">ເບີໂທ</label>
                <div class="col-sm-9">
                    {{ $message->tel }}
                </div>
            </div>
            <div class="mb-1 row">
                <label for="" class="col-sm-3 text-end">Email</label>
                <div class="col-sm-9">
                    {{ $message->email }}
                </div>
            </div>


        </div>
        <div class="col-md-8 fs-4">
            <label for="">ຂໍ້ຄວາມທີ່ສົ່ງຫາ</label>
            <textarea name="" id="" class="form-control" rows="10" readonly>
            {{ $message->message }}
        </textarea>
        </div>
    </div>
    <hr>
    <div class="row">

        <div class="col-md-12">
            @if ($message->email)
                <a href="mailto:{{ $message->email }}?subject=Re:{{ $message->title }}&body=ສະບາຍດີ {{ $message->name }}"
                    class="btn btn-light border shadow btn-lg"><i class="me-2 fs-4 bi bi-telegram"></i>ຕອບກັບ</a>
            @endif

            <a href="{{route('MessageToUsController.DeleteMessage',['id'=>$message->id])}}" onclick="return confirm('Are you sure to delete this item ?')"
                class="btn btn-danger btn-lg border ms-3 shadow">
                <i class="bi bi-trash fs-4"></i> ລຶບ
            </a>
        </div>

    </div>
@endsection
