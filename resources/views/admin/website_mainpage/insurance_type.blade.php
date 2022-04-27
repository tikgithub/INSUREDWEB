@php
use App\Utils\ImageCompress;
@endphp
@extends('layouts.admin_layout')
@section('content')
    
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
    {{-- Add Button --}}
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
                        <form action="{{ route('WebsiteController.StoreInsuraceTypePage') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="file" name="image_path" id="image_path"
                                        class="form-control-file form-control-file-log">
                                </div>
                                <div class="mb-3">
                                    <label for="">Link</label>
                                    <input type="text" name="url" id="url" class="form-control form-control-lg">
                                </div>
                                <div class="mb-3">
                                    <label for="">ລຳດັບການສະແດງຜົນ</label>
                                    <input type="number" name="order_to_display" id="order_to_dislpay"
                                        class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                        class="bi bi-x-circle"></i> ອອກ</button>
                                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i>
                                    ຕົກລົງ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Button --}}
    {{-- Table to display the image content --}}
    <div class="row pt-5">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Image File</th>
                    <th>URL</th>
                    <th><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($insuranceTypes as $item)
                        <tr class="align-middle">
                            <td>{{ $item->order_to_display }}</td>
                            <td>
                                <img src="{{ ImageCompress::getThumnailImage($item->image_path) }}" class="image-thumbnail">
                            </td>
                            <td>
                                {{ $item->url }}
                            </td>
                            <td>
                                <button onclick="onClickEditModal({{collect($item)}})" data-bs-toggle="modal" data-bs-target="#editModal" type="button"
                                    class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                <a href="{{route('WebsiteController.DeleteInsuranceTypePage',['id'=>$item->id])}}" onclick="return confirm('Are you sure to delete this item?')" href="http://"
                                    class="btn btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Table to display the image content --}}

    {{-- Edit Button --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">ແກ້ໄຂມູນຮູບແບບປະກັນໄພ</h5>
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

@section('scripting')
    @include('toastrMessage')
    <script>
        var baseRoute = "{{url('')}}";
        function onClickEditModal(item){
            document.getElementById('editId').value = item.id;
            document.getElementById('editOrder').value = item.order;
            console.log(baseRoute + item.image_path)
            document.getElementById('preview_image').setAttribute('src',baseRoute + '/'+ item.image_path);
            document.getElementById('editURL').value = item.url;
            document.getElementById('editOrder').value = item.order_to_display;
        }
    </script>
@endsection

@section('styles')
    <style>
        .image-thumbnail {
            width: auto;
            height: 200px;
        }

    </style>
@endsection
