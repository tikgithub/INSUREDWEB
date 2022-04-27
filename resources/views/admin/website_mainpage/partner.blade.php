@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center fw-bold">ຄູ່ຮ່ວມປະກັນໄພ</h3>
        </div>
    </div>
    {{-- Navigation --}}
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showNewAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('WebsiteController.index') }}">Website Setting</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຄູ່ຮ່ວມປະກັນໄພ</li>
        </ol>
    </nav>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success btn-lg"><i
                    class="bi bi-plus-circle me-2"></i>ເພີ່ມ</button>
            {{-- Add Modal --}}
            <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-4" id="staticBackdropLabel">ເພີ່ມລາຍການ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal"><i
                                        class="bi bi-x-circle me-2"></i> ອອກ</button>
                                <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-check-circle"></i>
                                    ຕົກລົງ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
