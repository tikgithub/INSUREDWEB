@php

use App\Utils\ImageCompress;
use App\Models\User;

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
        <div class="row">
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
        <div class="row">
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
    {{-- <div id="commentSlider" class="carousel slide bg-white p-3 rounded" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#commentSlider" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#commentSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#commentSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="p-2 rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px; margin: auto;" alt="100%x280"
                                src="https://images.unsplash.com/photo-1532781914607-2031eca2f00d?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=7c625ea379640da3ef2e24f20df7ce8d">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <div class="text-center">
                                    <div class="ratings">
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="p-2 rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px; margin: auto;"
                                src="https://images.unsplash.com/photo-1517760444937-f6397edcbbcd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=42b2d9ae6feb9c4ff98b9133addfb698">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <div class="text-center">
                                    <div class="ratings">
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="p-2 rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px; margin: auto;"
                                src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3d2e8a2039c06dd26db977fe6ac6186a">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <div class="text-center">
                                    <div class="ratings">
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="p-2 rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px; margin: auto;"
                                src="https://images.unsplash.com/photo-1532771098148-525cefe10c23?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3f317c1f7a16116dec454fbc267dd8e4">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <div class="text-center">
                                    <div class="ratings">
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="p-2 rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px; margin: auto;"
                                src="https://images.unsplash.com/photo-1532715088550-62f09305f765?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ebadb044b374504ef8e81bdec4d0e840">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <div class="text-center">
                                    <div class="ratings">
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="p-2 rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px; margin: auto;"
                                src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=0754ab085804ae8a3b562548e6b4aa2e">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <div class="text-center">
                                    <div class="ratings">
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="carousel-item">
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="p-2 rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px; margin: auto;"
                                src="https://images.unsplash.com/photo-1532771098148-525cefe10c23?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3f317c1f7a16116dec454fbc267dd8e4">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <div class="text-center">
                                    <div class="ratings">
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="p-2 rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px; margin: auto;"
                                src="https://images.unsplash.com/photo-1532715088550-62f09305f765?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=ebadb044b374504ef8e81bdec4d0e840">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <div class="text-center">
                                    <div class="ratings">
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img class="p-2 rounded-circle"
                                style="object-fit: cover; width: 200px; height: 200px; margin: auto;"
                                src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=0754ab085804ae8a3b562548e6b4aa2e">
                            <div class="card-body text-center">
                                <h4 class="card-title">Special title treatment</h4>
                                <p class="card-text">With supporting text below as a natural lead-in to additional
                                    content.</p>
                                <div class="text-center">
                                    <div class="ratings">
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star-fill rating-color me-2"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#commentSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#commentSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div id="rootCommentCarosel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    @foreach ($comments as $item)
                        <div class="carousel-item {{$loop->index == 0? 'active':''}}">
                            @foreach ($comments as $innerItem)
                                   
                            @endforeach

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

    <div class="row">
        <div class="col-md-12 notosanLao">
            <h3 class="ms-3 fw-bold fs-2">ຕິດຕໍ່ພວກເຮົາ</h3>
        </div>
    </div>
    <div class="row bg-white p-3 rounded">
        {{-- Contact us Form --}}
        <div class="col-md-6">
            <form id="contactForm" class="notosanLao text-center">
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
                            <input type="text" placeholder="ອີເມວ" id="email" class="form-control" name="email" required
                                data-error="Please enter your email">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <input type="text" placeholder="ຫົວຂໍ້" id="msg_subject" class="form-control" required
                                data-error="Please enter your subject">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <textarea class="form-control notosanLao" id="message" placeholder="ຂໍ້ຄວາມ" rows="7" data-error="Write your message"
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
