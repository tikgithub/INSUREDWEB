@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center fw-bold">Image Slide</h3>
        </div>
    </div>
    {{-- Navigation --}}
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showNewAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('WebsiteController.index') }}">Website Setting</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຮຸບແບບປະກັນໄພ</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <button data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success"><i
                    class="bi bi-plus-circle me-2"></i>ເພີ່ມ</button>
            <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">ເພີ່ມຂໍ້ມູນຮູບແບບປະກັນໄພ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                               <div class="mb-3">
                                    <input type="file" name="image_path" id="image_path" class="form-control-file form-control-file-log">
                               </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                        class="bi bi-x-circle"></i> ອອກ</button>
                                <button type="button" class="btn btn-success"><i class="bi bi-check-circle"></i>
                                    ຕົກລົງ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
