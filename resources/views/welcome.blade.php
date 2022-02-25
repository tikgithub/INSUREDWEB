@extends('layouts.public_layout')
@section('nav-content')
<div class="pt-4" style="margin-top: 10px;"></div>
{{-- Carousel Section --}}
<div class="">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="">
            <div class="carousel-item active">
                <img src="{{asset('assets/image/carousel1.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/image/carousel2.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/image/carousel3.jpg')}}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
{{-- End Carousel Section --}}
@endsection
@section('content')
{{-- Padding --}}
<div class="pt-3"></div>
{{-- ********************************************************************* --}}
<div class="row">
    <div class="col-md-12 text-center notosanLao">
        <h3>ຮູບແບບປະກັນໄພ</h3>
    </div>
</div>
{{-- padding --}}
<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
      <div class="car">
        <div class="card-body">
            <a href="http://">
                <img src="{{asset('assets/image/example1.jpeg')}}" class="card-img-top shadow" alt="...">
            </a>
        </div>
      </div>
    </div>
    <div class="col">
        <div class="car">
          <div class="card-body">
              <a href="http://">
                  <img src="{{asset('assets/image/example1.jpeg')}}" class="card-img-top shadow" alt="...">
              </a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="car">
          <div class="card-body">
              <a href="http://">
                  <img src="{{asset('assets/image/example1.jpeg')}}" class="card-img-top shadow" alt="...">
              </a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="car">
          <div class="card-body">
              <a href="http://">
                  <img src="{{asset('assets/image/example1.jpeg')}}" class="card-img-top shadow" alt="...">
              </a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="car">
          <div class="card-body">
              <a href="http://">
                  <img src="{{asset('assets/image/example1.jpeg')}}" class="card-img-top shadow" alt="...">
              </a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="car">
          <div class="card-body">
              <a href="http://">
                  <img src="{{asset('assets/image/example1.jpeg')}}" class="card-img-top shadow" alt="...">
              </a>
          </div>
        </div>
      </div>

  </div>
{{-- ********************************************************************* --}}


{{-- ****************************** HOW TO PAY *************************** --}}
<div class="row">
    <div class="col-md-12">
        <a href="http://">
            <img src="{{asset('assets/image/example1.jpeg')}}" class="card-img-top shadow" alt="...">
        </a>
    </div>
</div>
{{-- ********************************************************************* --}}
@endsection

@section('footer')
<nav class=" bg-blue" style="margin-bottom: -150px;" >
    <div class="container-fluid">
        <div class="row" style="padding-bottom: 100px;">
            <div class="col-md-12 pt-2 d-flex justify-content-end align-self-center">
                <span class="col-md-6">
                    <h4 class="text-white">{{config("app.name")}}</h4>
                </span>
                <span class="col-md-6 d-flex justify-content-end align-self-center">
                    <img class="ms-2" src="{{asset('assets/image/facebook.png')}}" style="width: auto;height: 30px;">
                    <img class="ms-2" src="{{asset('assets/image/instragram.png')}}" style="width: auto;height: 30px;">
                    <img class="ms-2"  src="{{asset('assets/image/linkined.png')}}" style="width: auto;height: 30px;">
                </span>
            </div>

        </div>
    </div>
</nav>

@endsection
