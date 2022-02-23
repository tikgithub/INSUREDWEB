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
    <form action="" method="post" class="notosanLao">
        <div class="row mb-3">
            <div class="col-md-6 offset-md-3">
                {{-- Image Profile section --}}
                <div class="row mb-3">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{ Auth::user()->profile_photo ? asset(Auth::user->profile_photo) : asset('assets/image/user_thumnail.png') }}"
                            class="rounded-circle border" style="width: auto;height: 100px; object-fit: cover">
                    </div>
                </div>
                {{-- Button Section --}}
                <div class="row">
                    <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                        <input type="file" name="profile_photo" id="profile_photo" hidden>
                        <button type="button" class="btn btn-warning me-2"><i class="bi bi-folder"></i> ເລືອກ</button>
                        <button type="submit" class="btn bg-blue text-white"><i class="bi bi-check-lg"></i> ບັນທຶກ</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <hr>
    {{-- End of Image Profile Update --}}


    {{-- Form Update --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @include('flashMessage')
            <h3 class="notosanLao">ຂໍ້ມູນພືນຖານ</h3>
            <form action="" method="post" class="notosanLao">
                @csrf
                {{-- Firstname --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text"
                        class="form-control form-control-lg {{ $errors->has('firstname') ? 'border-danger shadow' : '' }}"
                        placeholder="ຊື່" aria-label="firstname" name="firstname" value="{{ $user->firstname }}">

                </div>
                {{-- Lastname --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text"
                        class="form-control form-control-lg {{ $errors->has('lastname') ? 'border-danger shadow' : '' }}"
                        placeholder="ນາມສະກຸນ" aria-label="ັlastname" name="lastname" value="{{ $user->lastname }}">
                </div>
                {{-- Email --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope-open"></i></span>
                    <input type="email"
                        class="form-control form-control-lg {{ $errors->has('email') ? 'border-danger shadow' : '' }}"
                        placeholder="ອີເມວ" aria-label="email" name="email" value="{{ $user->email }}">
                </div>
                {{-- Telephone --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input type="text"
                        class="form-control form-control-lg {{ $errors->has('tel') ? 'border-danger shadow' : '' }}"
                        placeholder="ເບີໂທຕິດຕໍ່" aria-label="telephone" name="tel" value="{{ $user->tel }}">
                </div>

                {{-- Button submit --}}
                <div class="input-group mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn bg-blue text-white"><i class="bi bi-check-lg"></i> ບັນທຶກ</button>
                </div>
            </form>
        </div>
    </div>
    {{-- End Form Update --}}
    <hr>
    {{-- Form Change Password --}}
    <div class="row notosanLao">
        <div class="col-md-6 offset-md-3">
            <h3 class="notosanLao">ປ່ຽນລະຫັດຜ່ານ</h3>
            <form action="" method="post">
                {{-- Password --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-three-dots"></i></span>
                    <input type="password"
                        class="form-control form-control-lg {{ $errors->has('password') ? 'border-danger shadow' : '' }}"
                        placeholder="ລະຫັດຜ່ານ" aria-label="password" name="password">
                </div>
                {{-- Password Re-confirm --}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-three-dots"></i></span>
                    <input type="password"
                        class="form-control form-control-lg {{ $errors->has('confirmedPassword') ? 'border-danger shadow' : '' }} "
                        placeholder="ຢືນຢັນ ລະຫັດຜ່ານ" aria-label="Confirmed Password" name="confirmedPassword">
                </div>
                {{-- Check password validate failed return --}}
                @if ($errors->has('password'))
                    <p class="notosanLao alert-danger rounded shadow">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </form>
        </div>
    </div>
    {{-- End FormChange Password --}}

    <div class="fixed-bottom">
        @include('layouts.footer')
    </div>
@endsection
