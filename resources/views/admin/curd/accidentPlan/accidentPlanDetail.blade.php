@extends('layouts.admin_layout')
@section('content')
    <div class="pt-5"></div>
    {{-- Navigator bar --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('AdminController.showAdminDashBoard') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AdminController.indexDataManager') }}">ຈັດການຂໍ້ມູນ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('AccidentPlanController.index') }}">ກຳນົດລາຍການ PA/OPA</a></li>
            <li class="breadcrumb-item active" aria-current="page">ຕັ້ງວົງເງິນປະກັນ</li>
        </ol>
    </nav>
    {{-- End Navigator bar --}}
    <hr>
    {{-- Header --}}
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <img src="{{ asset($coverTypeData->companylogo) }}" style="width: auto; height:100px;" alt="" srcset="">
            <h3 class="pt-2">{{ $coverTypeData->companyname }} {{ $coverTypeData->name }}</h3>
            <h4>{{ $planDetail->name }}</h4>
        </div>
    </div>

    {{-- Table for display data --}}
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <table class="table table-hover">
                <thead>
                    <th>ລາຍການ
                    <th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($planItemDetails as $item)
                        <tr>
                            <td>{{ $item->item }}</td>
                            <td>
                                <input type="number" name="cover_price" id="cover_price{{ $item->cover_price }}"
                                    class="form-control" value="{{ $item->cover_price }}">
                            </td>
                            <td>
                                <button
                                    onclick="onClickUpdate({{ $item->id }},'cover_price{{ $item->cover_price }}')"
                                    type="button" class="btn btn-sm btn-warning">ແກ້ໄຂ</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripting')
    <script>
        function onClickUpdate(id, value_id) {
            var price = document.getElementById(value_id).value;
            //Data to update
            var updateData = {
                'update_id': id,
                'update_value': price
            };

            //Prepare fetch data
            var url = "{{ route('AccidentPlanController.updatePrice') }}";
            var token = "{{csrf_token()}}";
            console.log(url);

            fetch(url, {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/json',
                        'csrf-token': "{{csrf_token()}}"
                    },
                    body: JSON.stringify(updateData)
                }).then(response => response.json())
                .then(data => {
                    console.log("response: ", data);
                    toastr.success('Update Completed');
                }).catch((error => {
                    console.error(error);
                }));
        }
    </script>
@endsection
