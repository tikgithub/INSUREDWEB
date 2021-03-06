@php

use App\Utils\ImageCompress;
use App\Models\User;
use App\Utils\ImageServe;
@endphp
@extends('layouts.public_layout')
@section('nav-content')
    <div class="pt-4" style="margin-top: 50px;"></div>
    {{-- Carousel Section --}}
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($imageSlides as $item)
                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                    <img src="{{ asset($item->image_path) }}" class="d-block w-100" alt="...">
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- End Carousel Section --}}
@endsection
@section('content')
    {{-- Padding --}}
    {{-- ******************************  Insurance Type   ******************************** --}}
    @if (sizeof($insuranceType) > 0)
        <div class="row" id="category">
            <div class="col-md-12 text-center notosanLao">
                <h3 class="fw-bold fs-2">ຮູບແບບປະກັນໄພ</h3>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 p-3 bg-white rounded">
            @foreach ($insuranceType as $item)
                <div class="col h-100">
                    <div class="">
                        <div class="">
                            <a href="{{ $item->url }}">
                                <img src="{{ ImageCompress::getThumnailImage($item->image_path) }}"
                                    class="card-img-top zoom" alt="...">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ********************************************************************* --}}


    {{-- ****************************** HOW TO PAY *************************** --}}
    @if (sizeof($howtopays) > 0)
        <div class="row" id="howToBuy">
            <div class="col-md-12 notosanLao text-center">
                <h3 class="fs-2 fw-bold">ວິທີການຈ່າຍເງິນ</h3>
            </div>
        </div>
        <div class="row bg-white p-3 rounded">
            <div class="col-md-12">
                <div id="howToPayCarosuel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($howtopays as $item)
                            <button type="button" data-bs-target="#howToPayCarosuel" data-bs-slide-to="{{ $loop->index }}"
                                class="{{ $loop->index == 0 ? 'active' : '' }}" aria-current="true"
                                aria-label="Slide {{ $loop->index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($howtopays as $item)
                            <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                                <img src="{{ asset($item->image_path) }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#howToPayCarosuel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#howToPayCarosuel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ********************************************************************* --}}

    {{-- ******************************  Insurance Partner   ******************************** --}}
    @if (sizeof($partners) > 0)
        <div class="pt-5" id="partner"></div>
        <div class="row">
            <div class="col-md-12 text-center notosanLao">
                <h3 class="fw-bold fs-2">ຄູ່ຮ່ວມປະກັນໄພ</h3>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 p-3 bg-white rounded">
            @foreach ($partners as $item)
                <div class="col h-100">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ $item->url }}">
                                <img src="{{ asset($item->image_path) }}" class="card-img-top shadow" alt="...">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ********************************************************************* --}}

    {{-- ******************************  Insurance Partner   ******************************** --}}
    <div class="pt-5" id="howToBuy"></div>
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3 class="fs-2 fw-bold">ຄວາມຄິດເຫັນຂອງລູກຄ້າ</h3>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div id="rootCommentCarosel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($commentsArrayChunk as $comments)
                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($comments as $item)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                @php
                                                    $user = User::find($item->user_id);
                                                @endphp
                                                <img src="{{ asset($user->profile_photo) }}"
                                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">

                                                <p class="fs-4">{{$user->firstname}} {{$user->lastname}}</p>
                                                <p class="fs-5">{{$item->comment}}</p>
                                                <div class="ratings">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                       @php
                                                           if($i <= $item->rates){
                                                                echo '<i class="bi bi-star-fill rating-color me-2"></i>';
                                                           }
                                                           else{
                                                                echo '<i class="bi bi-star"></i>';
                                                           }
                                                       @endphp
                                                    @endfor
                                                    {{-- <i class="bi bi-star-fill rating-color me-2"></i>
                                                    <i class="bi bi-star-fill rating-color me-2"></i>
                                                    <i class="bi bi-star-fill rating-color me-2"></i>
                                                    <i class="bi bi-star-fill rating-color me-2"></i>
                                                    <i class="bi bi-star"></i> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#rootCommentCarosel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#rootCommentCarosel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    {{-- ********************************************************************* --}}


    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3 class="fw-bold fs-2">ໃຫ້ຄຳຕິຊົມ</h3>
        </div>
    </div>
    <div class="row bg-white p-3 rounded ">
        <div class="col-md-12 notosanLao ">
            <form action="{{ route('UserCommentController.StoreUserComment') }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <div class="col-md-6 offset-md-3">
                        <input type="text" name="comment" id="comment" class="form-control form-control-lg">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-md-6 offset-md-3 text-center">
                        <div class="rating">

                            <label>
                                <input type="radio" name="stars" value="1" />
                                <span class="icon">★</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="2" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="3" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="4" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" value="5" />
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                            </label>
                        </div>
                    </div>

                </div>

                @if ($errors->has('stars'))
                    <div class="text-center fs-4 text-danger mb-3">
                        Please give at leaste 1 star
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-12 text-center notosanLao">
                        <button type="submit" class="btn btn-lg bg-blue text-white fs-4">ຕົກລົງ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
    {{-- End Comment Submit From Customer --}}

    <div class="row" id="contact">
        <div class="col-md-12 notosanLao">
            <h3 class="ms-3 fw-bold fs-2">ຕິດຕໍ່ພວກເຮົາ</h3>
        </div>
    </div>
    <div class="row bg-white p-3 rounded">
        {{-- Contact us Form --}}
        <div class="col-md-6">
            <form id="contactForm" class="notosanLao text-center" action="{{route('MessageToUsController.StoreMessage')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="ຊື່" required
                                data-error="Please enter your name">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" placeholder="ອີເມວ" id="email" name="email" class="form-control" name="email"
                                data-error="Please enter your email">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <input type="text" name="tel" id="tel" class="form-control" required placeholder="ເບີໂທ: xx xxx xxx">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <input type="text" placeholder="ຫົວຂໍ້" id="msg_subject" name="title" class="form-control" required
                                data-error="Please enter your subject">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <textarea class="form-control notosanLao" id="message" name="message" placeholder="ຂໍ້ຄວາມ" rows="7" data-error="Write your message"
                                required></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="submit-button text-left">
                            <button class="btn bg-blue fs-4 text-white" id="form-submit" type="submit">ສົ່ງຂໍ້ຄວາມ</button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        {{-- End Contact us form --}}
        {{-- Website Information --}}
        <div class="col-md-6">
           
            <div style="border:0; height: 280px; width: 100%;" class="notosanLao">
                <p>
                    <img src="" class="" style="object-fit: cover; width: auto; height: 70px;">
                </p>
                <br>
                <p><b class="fs-3 notosanLao"></b>
                </p><br>
                <p class="notosanLao fs-4">
                    ອີເມວຕິດຕໍ່:
                </p>
                <p class="notosanLao fs-4">
                    ເບີໂທ:
                </p>
                <p class="notosanLao fs-4">
                    ທີ່ຢູ່:
                </p>
            </div>
        </div>
        {{-- End Website Information --}}
    </div>
    {{-- End Contact Us --}}


    <div class="mb-5"></div>
@endsection

@section('footer')
    @include('layouts.higher_footer')
@endsection

@section('style')
    <style>
        .height-100 {
            height: 100vh
        }

        .ratings {
            margin-right: 10px
        }

        .ratings i {
            color: #cecece;
            font-size: 32px
        }

        .rating-color {
            color: #fbc634 !important;
        }

        .review-count {
            font-weight: 400;
            margin-bottom: 2px;
            font-size: 18px !important
        }

        .small-ratings i {
            color: #cecece
        }

        .review-stat {
            font-weight: 300;
            font-size: 18px;
            margin-bottom: 2px
        }


        .rating {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 30px;
        }

        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child {
            position: static;
        }

        .rating label:nth-child(1) {
            z-index: 5;
        }

        .rating label:nth-child(2) {
            z-index: 4;
        }

        .rating label:nth-child(3) {
            z-index: 3;
        }

        .rating label:nth-child(4) {
            z-index: 2;
        }

        .rating label:nth-child(5) {
            z-index: 1;
        }

        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label .icon {
            float: left;
            color: transparent;
        }

        .rating label:last-child .icon {
            color: #000;
        }

        .rating:not(:hover) label input:checked~.icon,
        .rating:hover label:hover input~.icon {
            color: #fbc634;
        }

        .rating label input:focus:not(:checked)~.icon:last-child {
            color: #000;
            text-shadow: 0 0 5px #fbc634;
        }

    </style>
@endsection

@section('scripting')
@include('toastrMessage')
@endsection