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
            <li class="breadcrumb-item active" aria-current="page">Image Slide</li>

        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <button data-bs-toggle="modal" data-bs-target="#addModal" type="button" class="btn btn-success"><i
                    class="bi bi-plus-circle me-2"></i>ເພີ່ມ</button>

            <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">ເພີ່ມຮູບ Slide</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{route('WebsiteController.StoreSliderImage')}}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <input type="file" name="image" id="image" class="form-control-file form-control-file-lg mb-3" required>
                                <div class="mb-3">
                                    <label for="">ລຳດັບທີ່ຕ້ອງການສະແດງ</label>
                                    <input type="number" name="order_to_display" id="order_to_display"
                                        class="form-control form-control-lg" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                        class="bi bi-x-cirle me-2"></i>ອອກ</button>
                                <button type="submit" class="btn btn-success"><i class="bi bi-save me-2"></i>ຕົກລົງ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- display table --}}
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <td>#</td>
                    <td>Thumbnail</td>
                    <td class="text-center">
                        <i class="bi bi-gear"></i>
                    </td>
                </thead>
                <tbody>
                    @foreach ($imageData as $item)
                        <tr class="align-middle">
                            <td>{{$item->order_to_display}}</td>
                            <td>
                                <img src="{{ImageCompress::getThumnailImage($item->image_path)}}" class="image_thumbnail">
                            </td>
                            <td class="text-center">
                                <button onclick="onClickEditModal({{collect($item)}},'{{asset($item->image_path)}}')"  type="button" data-bs-toggle="modal" data-bs-target="#editMdal" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                <a onclick="return confirm('Are you sure to delete this item?')" href="{{route('WebsiteController.DeleteSlideImage',['id'=>$item->id])}}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editMdal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editMdalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMdalLabel">ແກ້ໄຂ Slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{route('WebsiteController.EditSlideImage')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body text-center">
                    @csrf
                    <input type="hidden" name="editId" id="editId" >
                    <img src="" id="previewImage" class="image_thumbnail mb-3">
                    <input type="file" name="image" id="image" class="form-control-file form-control-file-lg mb-3">
                    <div class="mb-3">
                        <label for="">ລຳດັບທີ່ຕ້ອງການສະແດງ</label>
                        <input type="number" name="order_to_display" id="editOrderToDisplay"
                            class="form-control form-control-lg" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="bi bi-x-cirle me-2"></i>ອອກ</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-pencil me-2"></i>ຕົກລົງ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('styles')
    <style>
        .image_thumbnail{
            width: auto;
            height: 100px;
        }
    </style>
@endsection
@section('scripting')
@include('toastrMessage')
    <script>
        
        function onClickEditModal(item, image_path){
         document.getElementById('editOrderToDisplay').value = item.order_to_display;
         document.getElementById('previewImage').src = image_path;
         document.getElementById('editId').value = item.id;
        }
    </script>
@endsection