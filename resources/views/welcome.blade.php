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
                    <img src="{{ asset('assets/image/carousel1.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/image/carousel2.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/image/carousel3.jpg') }}" class="d-block w-100" alt="...">
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
    <div class="pt-5"id="category"></div>
    {{-- ******************************  Insurance Type   ******************************** --}}
    <div class="row" >
        <div class="col-md-12 text-center notosanLao">
            <h3>ຮູບແບບປະກັນໄພ</h3>
        </div>
    </div>
    {{-- padding --}}
    <div class="pt-4"></div>
    <div class="row row-cols-1 row-cols-md-3 g-4 p-3 bg-white shadow rounded" >
        <div class="col h-100">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>

    </div>
    {{-- ********************************************************************* --}}


    {{-- ****************************** HOW TO PAY *************************** --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 notosanLao text-center">
            <h3>ວິທີການຈ່າຍເງິນ</h3>
        </div>
    </div>
    <div class="row pt-3 bg-white p-3 shadow rounded">
        <div class="col-md-12">

            <div id="howToPayCarosuel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#howToPayCarosuel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#howToPayCarosuel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#howToPayCarosuel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#howToPayCarosuel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#howToPayCarosuel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    {{-- ********************************************************************* --}}

    {{-- ******************************  Insurance Partner   ******************************** --}}
    <div class="pt-5" id="partner"></div>
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3>ຄູ່ຮ່ວມປະກັນໄພ</h3>
        </div>
    </div>
    <div class="pt-4"></div>
    {{-- padding --}}
    <div class="row row-cols-1 row-cols-md-3 g-4 p-3 bg-white shadow rounded">
        <div class="col h-100">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="http://">
                        <img src="{{ asset('assets/image/example1.jpeg') }}" class="card-img-top shadow" alt="...">
                    </a>
                </div>
            </div>
        </div>

    </div>
    {{-- ********************************************************************* --}}

    {{-- ******************************  Insurance Partner   ******************************** --}}
    <div class="pt-5" id="howToBuy"></div>
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3>ຄວາມຄິດເຫັນຂອງລູກຄ້າ</h3>
        </div>
    </div>
    {{-- Padding --}}
    <div class="pt-3"></div>
    <div id="commentSlider" class="carousel slide bg-white p-3 rounded shadow" data-bs-ride="carousel">
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
    </div>
    {{-- ********************************************************************* --}}

    {{-- Comment Submit From Customer --}}
    <div class="pt-5"></div>
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3>ໃຫ້ຄຳຕິຊົມ</h3>
        </div>
    </div>
    <div class="pt-3"></div>
    <div class="row bg-white p-3 rounded shadow">
        <div class="col-md-12 notosanLao">
            <form action="">
                <div class="mb-3 row">
                    <div class="col-md-6 offset-md-3">
                        <label for="">ຄຳຕິຊົມ</label>
                        <input type="text" name="comment" id="comment" class="form-control">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-md-6 offset-md-3 text-center">
                        <h5>ໃຫ້ຄະແນນ</h5>
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

                <div class="row mb-3">
                    <div class="col-md-12 text-center notosanLao">
                        <button type="submit" class="btn bg-blue text-white">ຕົກລົງ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Comment Submit From Customer --}}

    {{-- Contact Us --}}
    <div class="pt-5" id="contact"></div>
    <div class="row">
        <div class="col-md-12 text-center notosanLao">
            <h3>ຕິດຕໍ່ພວກເຮົາ</h3>
        </div>
    </div>
    <div class="pt-3"></div>
    <div class="row pt-5 bg-white p-3 rounded shadow">
        {{-- Contact us Form --}}
        <div class="col-md-6">
            <form id="contactForm" class="notosanLao">
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
                            <textarea class="form-control notosanLao" id="message" placeholder="ຂໍ້ຄວາມ" rows="7"
                                data-error="Write your message" required></textarea>
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
                    <img src="{{ asset('images/footerlogo.png') }}" class=""
                        style="object-fit: cover; width: auto; height: 70px;">
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

@section('styles')
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
