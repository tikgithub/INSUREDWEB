@extends('layouts.public_layout')
@section('content')
    {{-- Padding --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="notosanLao text-center">ຂໍ້ມູນຜູ້ໃຊ້</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            @include('flashMessage')
        </div>
    </div>

    {{-- Image Profile Update --}}
    <form action="{{route('UserController.changeProfilePhoto')}}" method="post" class="notosanLao" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 offset-md-3">
                {{-- Image Profile section --}}
                <div class="row mb-3">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{( Auth::user()->profile_photo !=null )? asset(Auth::user()->profile_photo) : asset('assets/image/user_thumnail.png') }}"
                            class="rounded-circle border" id="previewImage" style="width: 100px;height: 100px; object-fit: cover">
                    </div>
                </div>
                {{-- Button Section --}}
                <div class="row">
                    <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                        <input type="file" name="profile_photo" id="profile_photo" hidden onchange="onGetImageOK(event)"  accept="image/*">
                        <button type="button" class="btn btn-warning me-2" onclick="onSelect()"><i class="bi bi-folder"></i> ເລືອກ</button>
                        <button type="submit" class="btn bg-blue text-white"><i class="bi bi-check-lg"></i> ບັນທຶກ</button>
                    </div>
                </div>
                {{-- FlashMessage --}}
                @if($errors->has("profile_photo"))
                    <div class="alert-danger text-center notosanLao mt-2">
                        ຍັງບໍ່ໄດ້ເລືອກຮູບ
                    </div>
                @endif
            </div>
        </div>
    </form>
    <hr>
    {{-- End of Image Profile Update --}}


    {{-- Form Update --}}
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <h3 class="notosanLao">ຂໍ້ມູນພືນຖານ</h3>
            <form action="{{route('UserController.updateBasicInformation')}}" method="post" class="notosanLao">
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
                    <button type="submit" class="btn bg-blue text-white"><i class="bi bi-pencil-square"></i> ແກ້ໄຂ</button>
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
            <form action="{{route('UserController.changeUserPassword')}}" method="post">
                @csrf
                {{-- Password old--}}
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-clock-history"></i></span>
                    <input type="password"
                        class="form-control form-control-lg {{ $errors->has('password') ? 'border-danger shadow' : '' }}"
                        placeholder="ລະຫັດຜ່ານເກົ່າ" aria-label="password" name="oldPassword">
                </div>
                {{-- Password new --}}
                <div class="input-group mb-1">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password"
                        class="form-control form-control-lg {{ $errors->has('confirmedPassword') ? 'border-danger shadow' : '' }} "
                        placeholder="ລະຫັດຜ່ານໃໝ່" aria-label="Confirmed Password" name="confirmedPassword1">
                </div>
                 {{-- Re-confirm new password--}}
                 <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                    <input type="password"
                        class="form-control form-control-lg {{ $errors->has('confirmedPassword') ? 'border-danger shadow' : '' }} "
                        placeholder="ຢືນຢັນ ລະຫັດຜ່ານໃໝ່" aria-label="Confirmed Password" name="confirmedPassword2">
                </div>
                {{-- Check password validate failed return --}}
                @if ($errors->has('oldPassword'))
                    <p class="notosanLao alert-danger rounded shadow">
                        {{ $errors->first('oldPassword') }}
                    </p>
                @endif
                <div class="mb-3 text-center">
                    <button type="submit" class="btn bg-blue text-white notosanLao"><i class="bi bi-pencil-square"></i> ປ່ຽນລະຫັດຜ່ານ</button>
                </div>
            </form>
        </div>
    </div>
    {{-- End FormChange Password --}}



    <div class="fixed-bottom">
        @include('layouts.footer')
    </div>
@endsection
@section('scripting')
    <script>
        function onSelect(){
            var inputFile = document.getElementById('profile_photo');
            inputFile.click();
        }
        function onGetImageOK(event){
            if(document.getElementById('profile_photo').files.length == 0){
                console.log('no file selected');
            }else{

                console.log('file selected 1');
                var previewImage = document.getElementById('previewImage');
               previewImage.src = URL.createObjectURL(event.target.files[0]);
            }
        }
    </script>
@endsection
