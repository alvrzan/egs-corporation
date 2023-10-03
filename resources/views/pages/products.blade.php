@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/content.css') }}">
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
@endsection

@section('content')
<head class="msg">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->has('error'))
    <div class="alert alert-danger">
        {{ $errors->first('error') }}
    </div>
@endif

</head>
{{-- <section class="section animated-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="section-heading">Aceh Coffee</h1>
                <p class="section-description">Experience the popularity of Seed Of Gayo Coffee, renowned for its exceptional quality and distinct flavor, originating from the captivating region of Aceh</p>
                <a class="purchase btn btn-outline-primary" href="#">See More</a>
                <a class="purchase btn btn-primary" href="#">Purchase</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/coffee-1.jpg') }}" alt="Aceh Coffee" class="section-image img-fluid">
            </div>
        </div>
    </div>
</section> --}}

@foreach($products as $index => $product)
<section class="section animated-section">
    <div class="container">
        <div class="row row-bg">
            @if($index % 2 == 0)
            <div class="col-md-6">
                <div class="product-details">
                    <h1 class="section-heading">{{ $product->name }}</h1>
                    <h2 class="section-price">Price: RP {{ number_format($product->price, 0, ',', '.') }}</h2>
                    <p class="section-description">{{ $product->description }}</p>
                    <div class="button-container">
                        <form method="POST" action="{{ route('add.product', ['productId' => $product->id]) }}">
                            @csrf
                            <button type="submit" class="purchase btn btn-outline-primary">Add To Cart</button>
                        </form>
                        @auth
                        <a class="purchase btn btn-primary" href="{{ route('user.profile') }}">Purchase</a>
                        @else
                        <a class="purchase btn btn-primary" href="{{ route('login') }}">Login to Purchase</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-md-6 pd">
                @if ($product->images)
                <div id="productCarousel{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ $image->image_path }}" class="d-block w-100" alt="Product {{ $product->name }}">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel{{ $product->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel{{ $product->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#productCarousel{{ $product->id }}').carousel({
                            interval: 1000
                        });
                    });
                </script>
                @else
                <p>No images available for this product.</p>
                @endif
            </div>
            @else
            <div class="col-md-6">
                @if ($product->images)
                <div id="productCarousel{{ $product->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ $image->image_path }}" class="d-block w-100" alt="Product {{ $product->name }}">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel{{ $product->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel{{ $product->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#productCarousel{{ $product->id }}').carousel({
                            interval: 1000
                        });
                    });
                </script>
                @else
                <p>No images available for this product.</p>
                @endif
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <h1 class="section-heading">{{ $product->name }}</h1>
                    <h2 class="section-price">Price: RP {{ number_format($product->price, 0, ',', '.') }}</h2>
                    <p class="section-description">{{ $product->description }}</p>
                    <div class="button-container">
                        <form method="POST" action="{{ route('add.product', ['productId' => $product->id]) }}">
                            @csrf
                            <button type="submit" class="purchase btn btn-outline-primary">Add To Cart</button>
                        </form>
                        @auth
                        <a class="purchase btn btn-primary" href="{{ route('user.profile') }}">Purchase</a>
                        @else
                        <a class="purchase btn btn-primary" href="{{ route('login') }}">Login to Purchase</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endforeach


@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                items: 1,
                autoplay: true,
                autoplayTimeout: 2000,
                loop: true,
                nav: true,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>']
            });
        });
    </script>
@endsection
