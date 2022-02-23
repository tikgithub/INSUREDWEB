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
      <li class="breadcrumb-item"><a href="{{route('AdminController.showAdminDashBoard')}}">ໜ້າຫຼັກ</a></li>
      <li class="breadcrumb-item"><a href="AdminController.indexDataManager">ຈັດການຂໍ້ມູນ</a></li>
      <li class="breadcrumb-item active" aria-current="page">ຂໍ້ມູນບໍລິສັດປະກັນໄພ</li>
    </ol>
  </nav>
{{-- End Navigator bar --}}
<hr>
{{-- Body --}}
<div class="row">
    <div class="col-md-4 offset-md-4">
        {{-- Form --}}
        <form action="" method="post" class="notosanLao">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" id="name" class="form-control" placeholder="ຊື່ບໍລິສັດ">
            </div>
            <div class="mb-3">
                <input type="text" name="info" id="info" class="form-control" placeholder="ຂໍ້ມູນທົ່ວໄປ">
            </div>
            <div class="mb-1">
                <input type="text" name="address" id="address" class="form-control" placeholder="ທີ່ຢູ່">
            </div>
            <div class="mb-3 text-center">
                <input type="file" name="logo" id="logo" hidden onchange="onLogoGetImage(event)">
                <img src="" style="width: auto;height: 150px;" class="me-5 mb-1" id="logoPreview" alt="" srcset=""><br>
                <button onclick="onClickSelect()" type="button" class="btn btn-warning"><i class="bi bi-folder2"></i> ເລືອກ Logo</button>
            </div>

            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-success">ເພີ່ມຂໍ້ມູນ</button>
            </div>
        </form>
        {{-- End Form --}}
    </div>
</div>
{{-- End body --}}
@endsection

@section('scripting')
    <script>
       function onClickSelect(){
            document.getElementById('logo').click();
        }
        function onLogoGetImage(event){
            document.getElementById('logoPreview').src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection