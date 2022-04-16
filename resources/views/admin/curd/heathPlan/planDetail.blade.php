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
            <li class="breadcrumb-item"><a href="{{ route('HeathCoverItemController.Index') }}">ປະເພດການຄຸ້ມຄອງ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ແຜນ ແລະ ລາຄາຄຸ້ມຄອງ
                ({{ $headerTitleData->cover_name }})</li>
        </ol>
    </nav>
    <hr>
    {{-- End Navigator bar --}}
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset($headerTitleData->logo) }}" alt="{{ $headerTitleData->company_name }}"
                class="company_logo rounded mb-2">
            <h3>{{ $headerTitleData->cover_name }} {{ $headerTitleData->plan_name }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <table class="table table-hover">
                @foreach ($priceUpdateData as $item)
                    <form action="{{route('HeathPlanDetailController.Update',['plan_detail_id'=>$item->id])}}" method="get">
                        <tr>
                            <td class="align-middle">{{ $item->item_name }}</td>
                            <td><input type="number" name="cover_price" class="form-control form-control-lg" value="{{$item->cover_price}}"></td>
                            <td class="align-middle">
                                <button type="submit" class="btn btn-warning"><i class="bi bi-pencil"></i>ແກ້ໄຂ</button>
                            </td>
                        </tr>
                    </form>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('scripting')
    @include('toastrMessage')
    <script></script>
@endsection
@section('styles')
    <style>
        .company_logo {
            width: auto;
            height: 100px;
        }

    </style>
@endsection
