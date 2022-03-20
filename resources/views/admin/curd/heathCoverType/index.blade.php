@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3>ຂໍ້ມູນປະເພດການຄຸ່ມຄອງ PA/OPA</h3>
        </div>
    </div>
    {{-- End Header --}}
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="AdminController.indexDataManager">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຂໍ້ມູນປະເພດການຄຸ່ມຄອງ PA/OPA</li>
        </ol>
    </nav>
    {{-- End Navigator bar --}}
    <hr>

    {{-- Search Panel --}}
    <div class="row notosanLao">
        <div class="col-md-3 text-center">
            <select name="search_by_company" id="search_by_company" class="form-select">
                <option value="">ທັງໝົດ</option>
                @foreach ($companies as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal"><i
                    class="bi bi-plus-circle"></i> ເພີ່ມ</button>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    {{-- Table display Panel --}}
    <div class="row notosanLao">
      <div class="col-md-12">
        <table class="table table-hover">
          <thead class="fs-5">
            <th>#</th>
            <th>ປະເພດການຄຸ່ມຄອງ</th>
            <th>ການເຜີຍແພ່</th>
            <th><i class="bi bi-gear"></i></th>
          </thead>
          <tbody>
            @foreach ($heathCoverTypes as $item)
                <tr>
                  <td>{{$heathCoverTypes->firstItem()+ $loop->index}}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
        {{$heathCoverTypes->links('pagination::bootstrap-5')}}
      </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleAddModal" aria-hidden="true">
        <div class="modal-dialog notosanLao">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleAddModal">ເພີ່ມຂໍ້ມູນປະເພດປະກັນໄພ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('HeathCoverTypeController.store')}}" method="post" autocomplete="off">
                      @csrf
                        <div class="mb-3">
                            <label for="">ບໍລິສັດປະກັນໄພ</label>
                            <select name="insurance_company" id="insurance_company" class="form-select" required>
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">ປະເພດການຄຸ້ມຄອງ</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i>
                        ອອກ</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> ເພີ່ມ</button>
                </div>
              </form>
            </div>
        </div>
    </div>
@endsection

@section('scripting')
  @include('toastrMessage')
@endsection
