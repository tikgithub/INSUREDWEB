@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
     {{-- Header --}}
     <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3>ກຳນົດລາຍການທີ່ຈະຄຸ້ມຄອງ PA/OPA</h3>
        </div>
    </div>
     {{-- Navigator bar --}}
     <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ກຳນົດລາຍການທີ່ຈະຄຸ້ມຄອງ PA/OPA</li>
        </ol>
    </nav>
    {{-- End Navigator bar --}}
    <hr>

    <div class="row notosanLao">
        <div class="col-md-12 text-center">
            <h4>ຄົ້ນຫາລາຍການ</h4>
            <div class="mb3">
              <div class="row">
                  <div class="col-md-4 offset-md-4">
                      <select name="company_id" class="form-select" id="company_id">
                          <option value="">ເລືອກ</option>
                      </select>
                  </div>
              </div>
            </div>
        </div>
    </div>
@endsection