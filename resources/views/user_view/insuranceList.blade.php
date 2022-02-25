@php
use Illuminate\Support\Facades\DB;
use App\Models\InsuranceCompany;
use App\Models\VehiclePackage;
use App\Models\SaleOption;
use App\Models\Level;
use App\Models\CarBrand;
use App\Models\Province;
use App\Utils\ImageCompress;

@endphp

@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="notosanLao text-center">
                ລາຍການປະກັນໄພຜ່ານມາ
            </h2>
        </div>
    </div>
    {{-- Navigation --}}
    {{-- Show Level detail --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb notosanLao">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">ໜ້າຫຼັກ</a></li>
            <li class="breadcrumb-item active" aria-current="page">ລາຍການປະກັນໄພ ຂອງ
                {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-9">

            @foreach ($orderData as $item)
                <div class="bg-white border item-container rounded">
                    @php
                        $company = InsuranceCompany::find(VehiclePackage::find(SaleOption::find($item->sale_options_id)->vp_id)->c_id);
                        $level = Level::find(VehiclePackage::find(SaleOption::find($item->sale_options_id)->vp_id)->lvl_id);
                        $saleOption = SaleOption::find($item->sale_options_id);
                    @endphp
                    <div class="align-middle">
                        <div class="row">
                            <div class="col-md-1 text-center align-self-center pt-2">
                                <img src="{{ asset($company->logo) }}" class="company-logo rounded">
                            </div>
                            <div class="col-md-8 text-center align-self-center pt-2">
                                <span
                                    class="ms-1 notosanLao fs-4">{{ $company->name . ' ' . $level->name . ' ' . $saleOption->name }}</span>
                            </div>
                            <div class="col-md-3 text-center align-self-center pt-2">
                                <span class="notosanLao fs-4 fw-bolder text-danger">
                                    {{ number_format($item->total_price, 0) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-md-12 text-center notosanLao">
                            <span>
                                @switch($item->payment_confirm)
                                    @case(null)
                                        <span class="badge rounded-pill notosanLao fs-6 bg-primary">ລໍຖ້າຢັງຢືນການຈ່າຍເງິນ</span>
                                    @break

                                    @case('WAIT_FOR_APPROVED')
                                        <span
                                            class="badge rounded-pill notosanLao fs-6 bg-warning text-dark">ລໍຖ້າຢັງຢືນການອານຸມັດ</span>
                                    @break

                                    @case('APPROVED_OK')
                                        @if ($item->end_date < Carbon\Carbon::now())
                                            <a class="btn-danger btn btn-sm ">ໝົດສັນຍາແລ້ວ ກົດເພື່ອຕໍ່ສັນຍາ</a>
                                        @endif
                                    @break

                                    @default
                                @endswitch
                            </span>

                        </div>
                    </div>

                    <hr>
                    {{-- Insurance Content --}}
                    <div class="row">
                        <div class="col-md-2 text-center">
                            {{-- Image --}}
                            <img class="car-image rounded" src="{{ ImageCompress::getThumnailImage(($item->front_image)) }}" alt="" srcset="">
                            {{-- End Image --}}
                        </div>
                        <div class="col-md-5">
                            <div class="ms-2 notosanLao mb-5">
                              
                                @php
                                    $vehicleBrand = CarBrand::find($item->vehicle_brand);
                                @endphp
                                <table>
                                    <tr>
                                        <td width="100" class="fw-bold">ຍີ່ຫໍ້ລົດ</td>
                                        <td>{{ $vehicleBrand->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">ເລກທະບຽນ</td>
                                        <td>{{ Province::find($item->registered_province)->province_name }}
                                            {{ $item->number_plate }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">ເລກຈັກ</td>
                                        <td>{{ $item->engine_number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">ເລກຖັງ</td>
                                        <td>{{ $item->chassic_number }}</td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                        <div class="col-md-5 text-center">
                            @if ($item->payment_confirm)
                                <h4 class="notosanLao">ວັນທີຈ່າຍເງິນ
                                    {{ date('d/m/Y H:i:A', strtotime($item->payment_time)) }}</h4>

                                <img id="slip-{{ $item->id }}"
                                    onclick="showImageFullScreen('slip-{{ $item->id }}')"
                                    src="{{ $item->slip_confirmed }}" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" style="width: auto; height: 120px; cursor: pointer;">
                            @endif
                        </div>

                    </div>
                    {{-- End Col --}}

                    <div class="row notosanLao pt-3">
                        <div class="col-md-12 text-center">
                            <table>
                                <tr class="text-center">
                                    <td><a href="{{ route('InsuranceFlowController.showInsuranceDetailByCustomer', ['id' => $item->sale_options_id]) }}"
                                            class="btn btn-sm btn-primary"><i class="bi bi-info-circle"></i>
                                            ການຄຸ້ມຄອງ</a></td>
                                    @if ($item->payment_confirm == 'WAIT_FOR_APPROVED')
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning ms-1"><i
                                                    class="bi bi-clock-history"></i> ລໍຖ້າການອານຸມັດ</button>
                                        </td>
                                    @elseif($item->payment_confirm == 'APPROVED_OK')
                                        <td>
                                            <a target="_blank" href="{{asset('tmpfolder/simple.jpeg')}}" class="btn btn-sm btn-success ms-1"><i
                                                    class="bi bi-journal-check"></i>
                                                ເລກທີ່ສັນຍາ {{ $item->contract_no }}</a>
                                        </td>

                                    @else
                                        <td><a href="{{ route('InsuranceFlowController.redirectToAgreement', ['id' => $item->id]) }}"
                                                class="btn btn-sm btn-success"><i class="bi bi-cash-stack"></i>
                                                ຈ່າຍເງິນ</a></td>
                                        <td><a data-bs-toggle="modal" onclick="showDeleteModal({{ $item->id }})"
                                                data-bs-target="#deleteModal" class="btn btn-sm btn-danger"><i
                                                    class="bi bi-x-square"></i> ຍົກເລີກ</a></td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="pt-3"></div>
            @endforeach
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen notosanLao">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="exampleModalLabel">ຫຼັກຖານການຈ່າຍເງິນ</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class=" d-flex justify-content-center">
                    <img src="" id="previewImage" class="img-fluid rounded" alt="" srcset="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ອອກ</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog notosanLao">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">ແຈ້ງເຕືອນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <p class="fs-4"> ຕ້ອງການລຶບລາຍການແມ່ນບໍ່?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="get" class="notosanLao">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ອອກ</button>
                        <button type="submit" class="btn btn-success">ຕົກລົງ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('footer')
<div class="">
    @include('layouts.footer')
</div>
@endsection
@section('scripting')
    <script>
        function showImageFullScreen(id) {
            var imageId = document.getElementById(id);
            console.log();
            var previewImage = document.getElementById('previewImage');
            previewImage.setAttribute('src', imageId.getAttribute('src'));
        }

        function download() {
            var image = new Image();
            image.onload = function() {
                console.log(image.width); // image is loaded and we have image width
            }
            var previewImage = document.getElementById('previewImage');
            image.src = previewImage.getAttribute('src');
            document.body.appendChild(image);
        }

        function showDeleteModal(id) {
            var formDelete = document.getElementById('deleteForm');
            var url = "{{ route('InsuranceFlowController.deleteTheInput', ['id' => ':id']) }}";
            url = url.replace(':id', id);
            formDelete.setAttribute('action', url);
        }
    </script>
@endsection
@section('styles')
    <style>
        .item-container {
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .company-logo {
            width: auto;
            height: 50px;
        }

        .car-image {
            width: 150px;
            height: auto;
        }

    </style>
@endsection
