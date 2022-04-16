@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>ຈັດການຂໍ້ມູນລາຍການທີ່ຄຸ້ມຄອງ</h3>
        </div>
    </div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຈັດການຂໍ້ມູນລາຍການທີ່ຄຸ້ມຄອງ</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="fs-4">ຄົ້ນຫາ</label>
            <select name="company_id" id="company_id" class="form-select form-select-lg" onchange="onSelectCompany()">
                <option value="">ເລືອກ</option>
                @foreach ($companies as $item)
                    @if (@isset($selected_company_id))
                        <option value="{{ $item->id }}" {{ $item->id == $selected_company_id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>


    {{-- display table --}}
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead class="fs-4">
                    <th>#</th>
                    <th>ປະເພດການຄຸ້ມຄອງ</th>
                    <th>ບໍລິສັດປະກັນ</th>
                    <th class="text-center"><i class="bi bi-gear"></i></th>
                </thead>
                <tbody>
                    @foreach ($coverTypes as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->company_name }}</td>
                            <td class="text-center">
                                <a href="{{ route('HeathCoverItemController.Create', ['cover_type_id' => $item->id]) }}"
                                    class="btn btn-success btn-sm"><i class="bi bi-plus-circle me-2"></i>ລາຍການຄຸ້ມຄອງ</a>
                                <a href="{{ route('HeathPlanController.Create', ['cover_type_id' => $item->id]) }}"
                                    class="btn btn-success btn-sm"><i class="bi bi-plus-circle me-2"></i>ແຜນ ແລະ ລາຄາ</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripting')
    @include('toastrMessage')
    <script>
        function callAddModal(item) {
            document.getElementById('add_cover_type_id').value = item.id;
        }

        function onSelectCompany() {
            var selection = document.getElementById('company_id');
            var selectedId = selection.options[selection.selectedIndex].value;
            console.log(selectedId);
            if (selectedId == "") {
                var indexURL = "{{ route('HeathCoverItemController.Index') }}";
                window.location.href = indexURL;
                return;
            }
            var url = "{{ route('HeathCoverItemController.getCoverTypeByCompany', ['company_id' => ':company_id']) }}";
            url = url.replace(':company_id', selectedId);

            window.location.href = url;
        }
    </script>
@endsection
