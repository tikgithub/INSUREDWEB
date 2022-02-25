@extends('layouts.admin_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3>ຂໍ້ມູນບໍລິສັດປະກັນໄພ</h3>
        </div>
    </div>
    {{-- End Header --}}
    {{-- Navigator bar --}}

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="AdminController.indexDataManager">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຂໍ້ມູນບໍລິສັດປະກັນໄພ</li>
        </ol>
    </nav>
    {{-- End Navigator bar --}}
    <hr>
    {{-- Body --}}
    <div class="row mb-3">
        <div class="col-md-4 offset-md-4 border pt-3">
            @include('flashMessage')
            {{-- Form --}}
            <form action="{{ route('InsuranceCompanyController.store') }}" method="post" class="notosanLao"
                autocomplete="off" enctype="multipart/form-data">
                @csrf
                {{-- Name --}}
                <div class="mb-3">
                    <input type="text" name="name" id="name" class="form-control {{$errors->has('name')? 'border-danger':''}}" placeholder="ຊື່ບໍລິສັດ">
                </div>
                {{-- Info --}}
                <div class="mb-3">
                    <input type="text" name="info" id="info" class="form-control {{$errors->has('info')? 'border-danger':''}}" placeholder="ຂໍ້ມູນທົ່ວໄປ">
                </div>
                {{-- Address --}}
                <div class="mb-3">
                    <input type="text" name="address" id="address" class="form-control {{$errors->has('address')? 'border-danger':''}}" placeholder="ທີ່ຢູ່">
                </div>
                {{-- Contact --}}
                <div class="mb-1">
                    <input type="text" name="contact" id="contact" class="form-control {{$errors->has('contact')? 'border-danger':''}}" placeholder="ຕິດຕໍ່">
                </div>
                {{-- Logo --}}
                <div class="mb-3">
                    <input type="file" name="logo" id="logo" hidden onchange="onLogoGetImage(event)">
                    <img src="" style="width: auto;height: 150px;" class="me-5 mb-1" id="logoPreview" alt=""
                        srcset=""><br>
                    <button onclick="onClickSelect()" type="button" class="btn btn-warning {{$errors->has('logo')? 'border-danger':''}}"><i class="bi bi-folder2"></i>
                        ເລືອກ Logo</button>
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success">ເພີ່ມຂໍ້ມູນ</button>
                </div>
            </form>
            {{-- End Form --}}
        </div>
    </div>
    {{-- Table  display information --}}
    <div class="row mb-3 notosanLao">
        <div class="col-md-6 offset-md-3">
            <hr>
            <table class="table table-sm table-hover">
                <thead>
                    <th>#</th>
                    <th>ຊື່</th>
                    <th>ຂໍ້ມູນ</th>
                    <th>ທີ່ຢູ່</th>
                    <th>ເບີຕິດຕໍ່</th>
                    <th>Logo</th>
                    <th><i class="bi bi-gear-fill"></i></th>
                </thead>
                <tbody>
                    @foreach ($companies as $item)
                        <tr class="align-middle">
                            <td>{{ $companies->firstItem() + $loop->index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->info }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->contact }}</td>
                            <td>
                                <img src="{{ asset($item->logo) }}" style="width: auto;height: 50px;">
                            </td>
                            <td>
                                <a onclick="callEditModal('{{$item->id}}','{{$item->name}}','{{$item->info}}','{{$item->address}}','{{$item->contact}}','{{$item->logo}}')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"><i
                                        class="bi bi-pencil-fill"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Page Navigator --}}
            {{ $companies->links('pagination::bootstrap-5') }}
        </div>
    </div>
    {{-- Table show information --}}
    {{-- End body --}}

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog notosanLao">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ແກ້ໄຂຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('InsuranceCompanyController.update')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="editId" value="">
                        @csrf
                        {{-- Name --}}
                        <div class="mb-3">
                            <input type="text" name="name" id="editName" class="form-control" placeholder="ຊື່ບໍລິສັດ">
                        </div>
                        {{-- Info --}}
                        <div class="mb-3">
                            <input type="text" name="info" id="editInfo" class="form-control" placeholder="ຂໍ້ມູນທົ່ວໄປ">
                        </div>
                        {{-- Address --}}
                        <div class="mb-3">
                            <input type="text" name="address" id="editAddress" class="form-control" placeholder="ທີ່ຢູ່">
                        </div>
                        {{-- Contact --}}
                        <div class="mb-3">
                            <input type="text" name="contact" id="editContact" class="form-control" placeholder="ຕິດຕໍ່">
                        </div>
                        {{-- Logo --}}
                        <div class="mb-1">
                            <input type="file" name="logo" id="editLogo" hidden onchange="onGetEditImage(event)">
                            <img src="" style="width: auto;height: 150px;" class="me-5 mb-1" id="editLogoPreview" alt=""
                                srcset=""><br>
                            <button onclick="onSelectEditImage()" type="button" class="btn btn-warning"><i
                                    class="bi bi-folder2"></i>
                                ເລືອກ Logo</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ອອກ</button>
                        <button type="submit" class="btn btn-warning">ແກ້ໄຂ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Edit Modal --}}
@endsection

@section('scripting')
    <script>
        function onClickSelect() {
            document.getElementById('logo').click();
        }

        function onLogoGetImage(event) {
            document.getElementById('logoPreview').src = URL.createObjectURL(event.target.files[0]);
        }

        function onSelectEditImage(){
            document.getElementById('editLogo').click();
        }
        function onGetEditImage(event){
            document.getElementById('editLogoPreview').src = URL.createObjectURL(event.target.files[0]);
        }
        function callEditModal(id,name,info,address,contact,logo){
            console.log(window.location.origin + '/' + logo);

            document.getElementById('editName').value = name;
            document.getElementById('editId').value = id;
            document.getElementById('editInfo').value = info;
            document.getElementById('editAddress').value = address;
            document.getElementById('editContact').value = contact;
            document.getElementById('editLogoPreview').src = window.location.origin + '/' + logo;
            
        }
    </script>
@endsection
