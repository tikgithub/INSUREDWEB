@extends('layouts.public_layout')
@section('content')
<div class="pt-5"></div>
    <div class="row">
        <div class="text-center col-md-6 offset-md-3">
            <div class="card shadow">
                <div class="card-header bg-blue">
                    <h3 class="notosanLao text-white">
                        ລົງທະບຽນ
                    </h3>
                </div>
                <div class="card-body notosanLao">
                    <p>
                        <img class="shadow bg-blue rounded p-2" src="{{asset('assets/image/mainlogo.png')}}"  style="width: auto;height: 100px;">
                    </p>
                    <div class="text-center">
                        @include('flashMessage')
                        <form action="{{route('UserController.storeUserInformation')}}" method="post">
                            @csrf
                            {{-- Firstname --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text" ><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control form-control-lg {{$errors->has('firstname')? 'border-danger shadow':''}}" placeholder="ຊື່" aria-label="firstname" name="firstname" value="{{old('firstname')}}">
                               
                            </div>
                            {{-- Lastname --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text" ><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control form-control-lg {{$errors->has('lastname')? 'border-danger shadow':''}}" placeholder="ນາມສະກຸນ" aria-label="ັlastname" name="lastname" value="{{old('lastname')}}">
                            </div>
                            {{-- Email --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text" ><i class="bi bi-envelope-open"></i></span>
                                <input type="email" class="form-control form-control-lg {{$errors->has('email')? 'border-danger shadow':''}}" placeholder="ອີເມວ" aria-label="email" name="email" value="{{old('email')}}">
                            </div>
                            {{-- Telephone --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" class="form-control form-control-lg {{$errors->has('tel')? 'border-danger shadow':''}}" placeholder="ເບີໂທຕິດຕໍ່" aria-label="telephone" name="tel" value="{{old('tel')}}">
                            </div>
                            <hr>
                            {{-- Password --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text" ><i class="bi bi-three-dots"></i></span>
                                <input type="password" class="form-control form-control-lg {{$errors->has('password')? 'border-danger shadow':''}}" placeholder="ລະຫັດຜ່ານ" aria-label="password" name="password">
                            </div>
                            {{-- Password Re-confirm --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text" ><i class="bi bi-three-dots"></i></span>
                                <input type="password" class="form-control form-control-lg {{$errors->has('confirmedPassword')? 'border-danger shadow':''}} " placeholder="ຢືນຢັນ ລະຫັດຜ່ານ" aria-label="Confirmed Password" name="confirmedPassword">
                            </div>
                            {{-- Check password validate failed return --}}
                            @if($errors->has('password'))
                                <p class="notosanLao alert-danger rounded shadow">
                                    {{$errors->first('password')}}
                                </p>
                            @endif
                            {{-- Button submit --}}
                            <div class="input-group mb-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-lg bg-blue text-white"><i class="bi bi-download"></i> ຕົກລົງ</button>
                            </div>
                        </form>
                    </div>
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