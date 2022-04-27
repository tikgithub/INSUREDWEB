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
            <li class="breadcrumb-item active" aria-current="page">ວິທີການຈ່າຍເງິນ</li>
        </ol>
    </nav>
    <hr>
    {{-- Add Button --}}
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="bi bi-plus-circle me-2"></i>ເພີ່ມ</button>
            {{-- Add Modal --}}
            <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">ເພີ່ມວິທີການຈ່າຍເງິນ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{route('WebsiteController.StoreHowToPay')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="">ຮູບພາບ</label>
                                    <input type="file" name="image_path" class="form-control-file form-control-lg" required>
                                </div>


                                <div class="mb-3">
                                    <label for="">URL(Optional)</label>
                                    <input type="text" name="url" id="" class="form-control form-control-lg">
                                </div>

                                <div class="mb-3">
                                    <label for="">ລຳດັບກາສະແດງຜົນ</label>
                                    <input type="number" name="order_to_display" id="" class="form-control form-control-lg" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                        class="bi bi-x-circle me-2"></i>ອອກ</button>
                                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle me-2"></i>
                                    ຕົກລົງ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Table display data --}}
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
                    @foreach ($howtopays as $item)
                        <tr class="align-middle">
                            <td>{{$item->order_to_display}}</td>
                            <td>
                                <img src="{{asset($item->image_path)}}" class="image-thumbnail">
                            </td>
                            <td>
                                {{$item->url}}
                            </td>
                            <td>
                                <button onclick="onClickEdit({{collect($item)}},'{{asset($item->image_path)}}')" data-bs-toggle="modal" data-bs-target="#editModal" type="button" class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                <a onclick="return confirm('Are you sure to delete this item ?');" href="{{route('WebsiteController.DeleteHowToPay',['id'=>$item->id])}}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
     <div class="modal-dialog modal-dialog-centered modal-md">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">ແກ້ໄຂວິທີການຈ່າຍເງິນ</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                     aria-label="Close"></button>
             </div>
             <form action="{{route('WebsiteController.UpdateHowToPay')}}" method="post" enctype="multipart/form-data">
                 @csrf
                 <input type="hidden" name="editId" id="editId">
                 <div class="modal-body">
                     <div class="mb-3">
                         <label for="">ຮູບພາບ</label>
                         <img src="" id="image_preview" class="img-fluid mb-3" alt="" srcset="">
                         <input type="file" name="image_path" class="form-control-file form-control-lg" required>
                     </div>


                     <div class="mb-3">
                         <label for="">URL(Optional)</label>
                         <input type="text" name="url" id="editURL" class="form-control form-control-lg">
                     </div>

                     <div class="mb-3">
                         <label for="">ລຳດັບກາສະແດງຜົນ</label>
                         <input type="number" name="order_to_display" id="editOrder" class="form-control form-control-lg" required>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                             class="bi bi-x-circle me-2"></i>ອອກ</button>
                     <button type="submit" class="btn btn-success"><i class="bi bi-check-circle me-2"></i>
                         ຕົກລົງ</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

@endsection

@section('styles')
<style>
    .image-thumbnail{
        width: auto;
        height: 100px;
    }
</style>
@endsection

@section('scripting')
@include('toastrMessage')
<script>
    function onClickEdit(item,img_path){
        document.getElementById('editId').value = item.id;
        document.getElementById('image_preview').setAttribute('src',img_path);
        document.getElementById('editURL').value = item.url;
        document.getElementById('editOrder').value = item.order_to_display;
    }
</script>
@endsection
