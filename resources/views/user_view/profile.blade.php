@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="notosanLao text-center">ຂໍ້ມູນຜູ້ໃຊ້</h3>
        </div>
    </div>
    
    
    {{-- Image Profile Update --}}
    <div class="row">
        <div class="col-md-4">
            
        </div>
    </div>
    {{-- End of Image Profile Update --}}


    {{-- Form Update --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @include('flashMessage')
            <form action="" method="post" class="notosanLao">
                @csrf
                {{-- Firstname --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text"
                        class="form-control form-control-lg {{ $errors->has('firstname') ? 'border-danger shadow' : '' }}"
                        placeholder="ຊື່" aria-label="firstname" name="firstname" value="{{$user->firstname}}">

                </div>
                {{-- Lastname --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text"
                        class="form-control form-control-lg {{ $errors->has('lastname') ? 'border-danger shadow' : '' }}"
                        placeholder="ນາມສະກຸນ" aria-label="ັlastname" name="lastname" value="{{$user->lastname}}">
                </div>
                {{-- Email --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope-open"></i></span>
                    <input type="email"
                        class="form-control form-control-lg {{ $errors->has('email') ? 'border-danger shadow' : '' }}"
                        placeholder="ອີເມວ" aria-label="email" name="email" value="{{$user->email}}">
                </div>
                {{-- Telephone --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input type="text"
                        class="form-control form-control-lg {{ $errors->has('tel') ? 'border-danger shadow' : '' }}"
                        placeholder="ເບີໂທຕິດຕໍ່" aria-label="telephone" name="tel" value="{{ old('tel') }}">
                </div>
                {{-- Password --}}
                {{-- <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-three-dots"></i></span>
                    <input type="password"
                        class="form-control form-control-lg {{ $errors->has('password') ? 'border-danger shadow' : '' }}"
                        placeholder="ລະຫັດຜ່ານ" aria-label="password" name="password">
                </div> --}}
                {{-- Password Re-confirm --}}
                {{-- <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-three-dots"></i></span>
                    <input type="password"
                        class="form-control form-control-lg {{ $errors->has('confirmedPassword') ? 'border-danger shadow' : '' }} "
                        placeholder="ຢືນຢັນ ລະຫັດຜ່ານ" aria-label="Confirmed Password" name="confirmedPassword">
                </div> --}}
                {{-- Check password validate failed return --}}
                @if ($errors->has('password'))
                    <p class="notosanLao alert-danger rounded shadow">
                        {{ $errors->first('password') }}
                    </p>
                @endif
                {{-- Button submit --}}
                <div class="input-group mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-lg bg-blue text-white"><i class="bi bi-download"></i>
                        ຕົກລົງ</button>
                </div>
            </form>
        </div>
    </div>
    {{-- End Form Update --}}
    <div class="fixed-bottom">
        @include('layouts.footer')
    </div>
@endsection
