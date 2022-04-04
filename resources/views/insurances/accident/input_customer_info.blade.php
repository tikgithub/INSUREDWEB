@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>

    {{-- Header Title --}}
    <div class="row mb-2">

        <div class="notosanLao col-md-12 text-center">
            <img src="{{ asset($planDatas->logo) }}" class="rounded mb-2" style="width: auto;height: 70px;">
            <h2>ປ້ອນຂໍ້ມູນລາຍລະອຽດຂອງປະພັນໄພ</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>
                {{ $planDatas->companyName }} {{ $planDatas->coverType }} - <b>{{ $planDatas->planName }}</b>
            </h3>

        </div>
    </div>

    {{-- End Header Title --}}
    <hr>
    <div class="row mb-2 pt-3">
        <div class="col-md-4">
            <h5>
                ເງືອນໄຂອາຍຸລະວ່າງ: {{ $plan->start_age }} - {{ $plan->end_age }}
            </h5>
            <table class="table table-hover table-bordered">
                <thead class="bg-blue text-white fs-4">
                    <th>#</th>
                    <th>ລາຍການຄຸ້ມຄອງ</th>
                    <th class="text-end">ວົງເງິນຄຸ້ມຄອງ</th>
                </thead>
                <tbody>
                    @foreach ($coverData as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="fs-5">{{ $item->item }}</td>
                            <td class="text-end fs-5">{{ number_format($item->cover_price, 0) }} ກີບ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="fs-4 fw-bold">
                            ລວມຄ່າທຳນຽມຕໍ່ປີ
                        </td>
                        <td class="text-end fs-4 fw-bold">
                            {{ number_format($plan->sale_price, 0) }} ກີບ
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-8">
            {{-- Check Customer Authentication --}}
            @if (Auth::check())
                {{-- Show Input form --}}
                <h4 class="text-center">ປ້ອນຂໍ້ມູນປະກັນໄພ</h4>
                <form action="" method="post">
                    <div class="card">
                        <div class="card-header">
                            <h2>ຂໍ້ມູນຜູ້ເອົາປະກັນ</h2>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </form>
            @else
                {{-- Show Login form --}}
                <h4 class="text-center">ທ່ານຍັງບໍ່ໄດ້ເຂົ້າສູ່ລະບົບ</h4>
                {{-- Login Session --}}
                <form action="{{ route('UserController.validateUserBeforeBuying') }}" method="post"
                    class="notosanLao shadow pt-4 p-3 mx-auto text-center" style="width: 400px">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                        <input type="email"
                            class="form-control form-control-lg text-center {{ $errors->has('email') ? 'border-danger' : '' }}"
                            placeholder="ອີເມວ" aria-label="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-asterisk"></i></span>
                        <input type="password"
                            class="form-control form-control-lg text-center {{ $errors->has('password') ? 'border-danger' : '' }}"
                            placeholder="ລະຫັດຜ່ານ" aria-label="password" name="password">
                    </div>
                    @if ($errors->has('password'))
                        <div class="alert-danger notosanLao rounded mb-3 p-2">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <div class="mb-1">
                        <button type="submit" class="btn bg-blue btn-lg text-white"><i class="bi bi-key"></i>
                            ຕົກລົງ</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
