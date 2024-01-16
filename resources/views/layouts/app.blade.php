<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exploresia Growth Seedonesia</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/egs.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Athiti:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @yield('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/company">
                <img class="logo" id="app-logo" src="{{ asset('images/app-logo.png') }}" alt="app-logo">
            </a>
            <a class="navbar-brand" href="/company">Exploresia Growth Seedonesia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex align-items-center">
                    {{-- <img src="{{ asset('images/logo1.jpg') }}" alt="Logo" class="logo-img me-2"> --}}
                    <h5 class="mb-0">With Us We Connect</h5>
                </div>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" id="home-link" href="/">Home</a>
                    </li>
                    @auth
                    @if (Auth::user()->role->name === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Panel Admin</a>
                    </li>
                    @endif
                    <li class="nav-item" style="display: none;">
                        <a class="nav-link" id="register-link" href="{{route('register')}}">Register</a>
                    </li>
                    @endauth
                    <!-- Jika pengguna belum login, tampilkan link "Register" -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" id="register-link" href="{{route('register')}}">Register</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" id="login-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" id="product-link" href="{{ route('products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="home-link" href="{{ route('contact') }}#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('shopping-cart') }}" class="cart-link">
                            <img class="cart" id="cart-icon" src="{{ asset('images/icon-fast-cart.png') }}" alt="Cart">
                            <span class="cart-text">Cart</span>
                            <span class="cart-count">0</span> <!-- Ini adalah bubble dengan angka -->
                        </a>
                    </li>
                    <li class="nav-item">
                        @auth
                            @if (empty(Auth::user()->avatar))
                                <a href="{{ route('dashboard') }}" class="acount-link">
                                    <img class="account rounded-circle" id="account-icon" data-hovered="false" src="{{ asset('images/account.png') }}" alt="{{ Auth::user()->profile_picture }}">
                                </a>
                            @else
                            <div class="account-link">
                                <div class="account-zoom">
                                    <a href="@if (Auth::user()->role->name === 'admin') {{ route('dashboard') }} @else {{ route('dashboard') }} @endif" class="acount-link">
                                        <img class="account rounded-circle" id="account-icon" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }}'s profile picture">
                                    </a>
                                </div>
                            </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="acount-link">
                                <img class="account rounded-circle" id="account-icon" src="{{ asset('images/account.png') }}" alt="Account">
                            </a>
                        @endauth
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span>&copy; 2023 PT Eksploresia Growth Seedonesia. All rights reserved. <i
                            class="fas fa-copyright"></i></span>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/slide.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ asset('js/ease.js') }}"></script> --}}
    <script src="{{ asset('js/zoom.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi untuk memperbarui bubble angka
        function updateCartCount() {
    $.ajax({
        url: "{{ route('cart.count') }}",
        method: "GET",
        success: function (data) {
            // Perbarui teks di dalam elemen span dengan jumlah item yang diambil dari respons AJAX
            $('.cart-count').text(data.count);
        }
    });
}

// Panggil fungsi updateCartCount() untuk pertama kali
updateCartCount();
</script>
</body>

</html>
