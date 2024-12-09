<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Homepage - Toko Sepatu</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Fontawesome icons-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('landing') }}"><span>My</span><span
                    class="text-warning">Store</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('landing') }}"><i
                                class="fas fa-home"></i>Home</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item"
                                        href="{{ route('landing', ['category' => $category->name]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">

                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light ms-1">
                            <i class="bi-person-fill me-1"></i>
                            Dashboard
                        </a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-light ms-1">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                    @endguest
                </form>
            </div>
        </div>
    </nav>
    <!-- Carousel-->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @foreach ($sliders as $slider)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="3000">
                    <img src="{{ asset('storage/slider/' . $slider->image) }}" class="d-block w-100"
                        alt="{{ $slider->image }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $slider->title }}</h5>
                        <p>{{ $slider->caption }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <form action="{{ route('landing') }}" method="GET">
                @csrf
                <div class="row g-3 my-5">
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Min" name="min"
                            value="{{ old('min') }}">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Max" name="max"
                            value={{ old('max') }}>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                @foreach ($products as $product)
                    @if ($product->status == 'approved')
                        <div class="col mb-5">
                            <div class="card h-100">
                                @if ($product['sale_price'] != 0)
                                    <!-- Sale badge-->
                                    <div class="badge bg-success text-white position-absolute"
                                        style="top: 0.5rem; right: 0.5rem">Sale</div>
                                @endif

                                <!-- Product image-->
                                <img class="card-img-top" src="{{ asset('storage/product/' . $product->image) }}"
                                    alt="{{ $product->image }}" />

                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <a href="{{ route('product.show', ['id' => $product->id]) }}"
                                            style="text-decoration: none" class="text-dark">
                                            <small class="text-strong">{{ $product->category->name }}</small>
                                            <h5 class="fw-bolder">{{ $product->name }}</h5>

                                        </a>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            @for ($i = 0; $i < $product->rating; $i++)
                                                <div class="bi-star-fill"></div>
                                            @endfor
                                        </div>
                                        <!-- Product price-->
                                        @if ($product['sale_price'] != 0)
                                            <span
                                                class="text-muted text-decoration-line-through">Rp.{{ number_format($product->price, 0) }}</span>
                                            Rp.{{ number_format($product->sale_price, 0) }}
                                        @else
                                            Rp.{{ number_format($product->price, 0) }}
                                        @endif
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <a class="btn btn-outline-light mt-auto bg-success"
                                            href="https://api.whatsapp.com/send?phone=123456789&text=Halo%2C%20saya%20tertarik%20untuk%20membeli%20produk%20{{ urlencode($product->name) }}">
                                            <i class="bi bi-whatsapp"></i>Pesan Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark" id="about">
        <div class="container text-light">
            <div class="row">
                <div class="col-6 px-4">
                    <h2 class="logo-brand"><span>My</span><span class="text-warning">Store</span></h2>
                    <p>My Store Merupakan Toko roti termurah dan terlenhkap</p>
                </div>
                <div class="col-6 px-4">
                    <p><i class="fa-solid fa-location-dot icon mx-3 ms-0"></i> Kecamatan Wanasari,
                        Brebes,
                        Jawa Tengah</p>
                    <small>Developed by</small>
                    <br>
                    <small>Aan Bayu Saputra</small>
                    <br>
                    <div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
                        <ul class="list-inline mt-4">
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/aanbayu.saputra.96" class="text-white">
                                    <i class="fab fa-facebook-square"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://twitter.com/" class="text-white">
                                    <i class="fab fa-twitter-square"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.instagram.com/anbayusptr/" class="text-white">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/in/aan-bayu-saputra-57676a261/" class="text-white">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://github.com/Aanbayusaputra/sib-fswd-laravel" class="text-white">
                                    <i class="fab fa-github"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://mail.google.com" class="text-white">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <hr>
            <p class="text-center"> &copy 2024 Aan Bayu Saputra| Java_Bakaery</p>
        </div>
    </footer>
    <!-- End Footer-->

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
