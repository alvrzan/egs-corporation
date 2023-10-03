@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endsection

@section('content')

<div id="success-message" class="alert alert-success" style="display: none; font-weight: bold;"></div>
<div id="error-message" class="alert alert-danger" style="display: none; font-weight: bold;"></div>

<div class="container-cart">
    <h1>Shopping Cart</h1>
    @if ($cartItems->count() > 0)
    <table class="table" id="cart-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th> <!-- Tambah kolom aksi -->
            </tr>
        </thead>
        <tbody>
            {{-- Looping untuk menampilkan produk yang ada di shopping-cart --}}
            @foreach($cartItems as $cartItem)
            <tr id="cart-item-{{ $cartItem->id }}">
                <td>{{ $cartItem->product->name }}</td>
                <td>Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}</td>
                <td>
                    <input type="number" class="form-control" value="{{ $cartItem->quantity }}" onchange="updateCartItemQuantity({{ $cartItem->id }}, this.value)">
                </td>
                <td>Rp {{ number_format($cartItem->quantity * $cartItem->product->price, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('delete-cart', ['id' => $cartItem->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        <h2>Total Price: Rp <span id="total-price">{{ number_format($totalPrice, 0, ',', '.') }}</span></h2>
        <form action="{{ route('create-transaction') }}" method="POST">
            @csrf <!-- Tambahkan CSRF token untuk keamanan -->
            <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
        </form>
            </div>
    @else
    <p>Your shopping cart is empty.</p>
    @endif
</div>

<script>
    // Panggil fungsi JavaScript untuk menampilkan pesan sesuai dengan session
    document.addEventListener('DOMContentLoaded', function () {
        @if (Session::has('success'))
        showSuccessMessage('<strong>{{ Session::get('success') }}</strong>');
        @endif

        @if (Session::has('error'))
        showErrorMessage('<strong>{{ Session::get('error') }}</strong>');
        @endif
    });

    // Fungsi untuk menampilkan pesan sukses dengan animasi fading
    function showSuccessMessage(message) {
        var successMessage = document.getElementById('success-message');
        successMessage.innerHTML = message;
        successMessage.style.display = 'block';

        // Sembunyikan pesan sukses setelah 1 detik
        setTimeout(function () {
            successMessage.style.display = 'none';
        }, 1500);
    }

    // Fungsi untuk menampilkan pesan error dengan animasi fading
    function showErrorMessage(message) {
        var errorMessage = document.getElementById('error-message');
        errorMessage.innerHTML = message;
        errorMessage.style.display = 'block';

        // Sembunyikan pesan error setelah 1 detik
        setTimeout(function () {
            errorMessage.style.display = 'none';
        }, 1500);
    }
</script>

@endsection
