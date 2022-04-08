@extends('layouts.public_layout')
@section('content')
    <div class="pt-3">

    </div>
    <div class="row">
        <div class="col-md-12 fs-3 text-center">
            ລາຍການປະກັນໄພຂອງທ່ານ {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
        </div>
    </div>
 <div class="pt-5"></div>

    {{-- High Value Vehicle Data --}}
        <div class="">
            <div class="row">
                <div class="col-md-1 text-center">
                    <img src="{{asset('assets/image/adjust.png')}}" alt="" class="img-fluid" srcset="">
                </div>
                <div class="col-md-11 text-end">
                    
                </div>
            </div>
        </div>
    <hr>
    {{-- High Value Vehicle Data End --}}
    
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('scripting')
    <script>
        
    </script>
@endsection


@section('style')
    <style>
       
    </style>
@endsection
