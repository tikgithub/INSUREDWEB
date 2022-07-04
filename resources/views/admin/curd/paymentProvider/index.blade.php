@extends('layouts.admin_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຂໍ້ມູນຊ່ອງທາງການຈ່າຍເງິນ</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}
    <h3 class="notosanLao text-center">ຂໍ້ມູນຊ່ອງທາງການຈ່າຍເງິນ</h3>

    {{-- Body --}}
    <div class="row">
        <div class="col-md-4 offset-md-4 notosanLao">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="bi bi-plus-circle me-1"></i> ເພີ່ມ</button>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">ເພີ່ມຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('PaymentProviderController.Store')}}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" id="name" class="form-control" placeholder="ຊື່ທະນາຄານ">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="account" id="account" class="form-control" placeholder="ເລກບັນຊີ">
                        </div>
                        <div class="mb-3">
                            <label for="">ຮູບ Logo</label>
                            <input type="file" name="logo" accept="image/x-png,image/gif,image/jpeg"  id="logo" class="form-control-file">
                        </div>
                        <div class="mb-3">
                            <label for="">QRScan</label>
                            <input type="file" name="qrscan" accept="image/x-png,image/gif,image/jpeg"  id="qrscan" class="form-control-file">
                        </div>
                        <div class="mb-3">
                            <label for="">ວິທີຈ່າຍເງິນ</label>
                            <input type="file" name="howto" accept="image/x-png,image/gif,image/jpeg"  id="howto" class="form-control-file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> ອອກ</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> ຕົກລົງ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Table data --}}
    <div class="row">
        <div class="col-md-12">
            <hr>
            <table class="table table-sm table-hover notosanLao">
                <thead>
                    <th>#</th>
                    <th>ຊື່ທະນາຄານ</th>
                    <th>Logo</th>
                    <th>ເລກບັນຊີ</th>
                    <th>QRCode</th>
                    <th>ວິທີການຈ່າຍເງິນ</th>
                    <th>Status</th>
                    <th><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($payments as $item)
                        <tr class="align-middle">
                            <td>{{$item->index + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td><img src="{{asset($item->logo)}}" class="logo-image" ></td>
                            <td>{{$item->account}}</td>
                            <td>
                                <img src="{{asset($item->qrscan)}}" class="qr-scan-image">
                            </td>
                            <td>
                                <img src="{{asset($item->howto)}}"  class="how-to-pay">
                            </td>
                            <td>
                                {{($item->status)=='1'? 'Opened':'Closed'}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {{-- End Body --}}

@endsection



@section('scripting')
@include('toastrMessage')
    <script>
        function callEditModal(id, name, menu_type) {
            document.getElementById('editName').value = name;
            document.getElementById('editId').value = id;

            var menu_typeSelect = document.getElementById('editMenuType');
            var options = menu_typeSelect.options;
            for (let i = 0; i < options.length; i++) {

                if (options[i].value == menu_type) {
                    options[i].selected = true;
                }
            }
        }
    </script>
@endsection

@section('styles')
<style>
    .logo-image{
        width: auto;
        height: 50px;
    }
    .qr-scan-image{
        width: auto;
        height: 100px;
    }
    .how-to-pay{
        width: auto;
        height: 100px;
    }
</style>
@endsection
