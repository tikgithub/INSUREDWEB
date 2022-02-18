@extends('layouts.public_layout')
@section('content')
<div class="pt-5"></div>
<div class="row">
    <div class="col-md-6 offset-md-3 text-center">
       <div class="card shadow">
           <div class="card-header notosanLao bg-blue">
            <h3 class="fs-4 text-white">
                ເຂົ້າສູ່ລະບົບ
            </h3>
           </div>
           <div class="card-body notosanLao">
               <p>
                   <img class="shadow bg-blue rounded-circle" src="{{asset('assets/image/mainlogo.png')}}"  style="width: auto;height: 100px;">
               </p>
            <p>
                @include('flashMessage')
                <form action="{{route('UserController.signIn')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control form-control-lg {{$errors->has('email')? 'border-danger':''}}" placeholder="ອີເມວ" aria-label="email" name="email" value="{{old('email')}}">
                      </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-asterisk"></i></span>
                        <input type="password" class="form-control form-control-lg {{$errors->has('password')? 'border-danger':''}}" placeholder="ລະຫັດຜ່ານ" aria-label="password"  name="password">
                    </div>
                    @if ($errors->has('password'))
                            <div class="alert-danger notosanLao rounded mb-3 p-2">
                                {{$errors->first('password')}}
                            </div>
                        @endif
                    <div class="mb-3">
                        <button type="submit" class="btn bg-blue btn-lg text-white"><i class="bi bi-key"></i> ຕົກລົງ</button>
                    </div>
                </form>
            </p>
           </div>
       </div>
    </div>
</div>
@endsection