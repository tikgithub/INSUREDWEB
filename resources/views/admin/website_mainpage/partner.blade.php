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
                        <form action="{{ route('WebsiteController.StorePartnerWebPage') }}" method="post"
                            enctype="multipart/form-data">
                            <div class="modal-body fs-4">
                                @csrf
                                <div class="mb-3">
                                    <label for="">ຮູບພາບ</label>
                                    <input type="file" name="image_path" id="image_path"
                                        class="form-control form-control-lg">
                                </div>
                                <div class="mb-3">
                                    <label for="">URL</label>
                                    <input type="text" name="url" id="url" class="form-control form-control-lg">
                                </div>
                                <div class="mb-3">
                                    <label for="">ລຳດັບສະແດງຜົນ</label>
                                    <input type="number" name="order_to_display" id="order_to_display"
                                        class="form-control form-control-lg">
                                </div>
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
    <div class="row pt-5">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Image</th>
                    <th>URL</th>
                    <th><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($partners as $item)
                        <tr class="align-middle">
                            <td>{{ $item->order_to_display }}</td>
                            <td>
                                <img src="{{ asset($item->image_path) }}" class="image-thumbnail">
                            </td>
                            <td>
                                {{ $item->url }}
                            </td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#editModal" type="button"
                                    class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                <a href="http://" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to delete this item?');"><i
                                        class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
{{-- Edit Modal --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content fs-4">
            <div class="modal-header">
                <h5 class="modal-title fs-4" id="staticBackdropLabel">ແກ້ໄຂ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('WebsiteController.UpdateInsuranceTypePage') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="editId" id="editId" >
                <div class="modal-body">
                    <div class="mb-3 ">
                        <img src="" class="img-fluid" id="preview_image">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="image_path" id="editImagePath"
                            class="form-control-file form-control-file-log">
                    </div>
                    <div class="mb-3">
                        <label for="">Link</label>
                        <input type="text" name="url" id="editURL" class="form-control form-control-lg">
                    </div>
                    <div class="mb-3">
                        <label for="">ລຳດັບການສະແດງຜົນ</label>
                        <input type="number" name="order_to_display" id="editOrder"
                            class="form-control form-control-lg">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                        ອອກ</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i>
                        ຕົກລົງ</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <style>
        .image-thumbnail {
            width: auto;
            height: 200px;
        }

    </style>
@endsection

@section('scripting')
    @include('toastrMessage')
    <script>

    </script>
@endsection
