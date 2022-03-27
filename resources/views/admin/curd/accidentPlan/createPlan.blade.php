@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AccidentPlanController.index') }}">ກຳນົດລາຍການ PA/OPA</a></li>
            <li class="breadcrumb-item active" aria-current="page">ກຳນົດລາຍການທີ່ຈະຄຸ້ມຄອງ PA/OPA</li>
        </ol>
    </nav>
    {{-- End Navigator bar --}}
    <hr>

    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <img src="{{ asset($coverTypeData->companylogo) }}" style="width: auto; height:100px;" alt="" srcset="">
            <h4 class="pt-2">{{ $coverTypeData->companyname }} {{ $coverTypeData->name }}</h4>
        </div>
    </div>

    {{-- Input Data --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <button type="button" data-bs-toggle="modal" data-bs-target="#addPlanModal" class="btn btn-success"><i
                    class="bi bi-plus-circle me-2"></i>ເພີ່ມ</button>
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>ແຜນ</th>
                    <th><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($plans as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="http://" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <a href="http://" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    {{-- Add Plan Modal --}}
    <!-- Modal -->
    <div class="modal fade" id="addPlanModal" tabindex="-1" aria-labelledby="addPlanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlanModalLabel">ເພີ່ມຂໍ້ມູນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" autocomplete="off">
                    <div class="modal-body">
                        <input type="hidden" name="cover_type_id">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="bi bi-x-circle"></i> ອອກ</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-plush-circle"></i> ບັນທຶກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
