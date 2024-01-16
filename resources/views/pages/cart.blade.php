@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endsection

@section('content')

<div id="success-message" class="alert alert-success" style="display: none; font-weight: bold;"></div>
<div id="error-message" class="alert alert-danger" style="display: none; font-weight: bold;"></div>

<div class="container container-cart">
    <div class="row">
        <h1>Shopping Cart</h1>
        <div class="col">
            @foreach($cartItems as $cartItem)
                <table>
                    <tr>
                        <td>
                            @if($cartItem->product->images->isNotEmpty())
                                <img class="image-cart img-thumbnail" src="{{ $cartItem->product->images->first()->image_path }}" alt="{{ $cartItem->product->name }}" width="120">
                            @else
                                <span>No image available</span>
                            @endif
                        </td>
                    </tr>
                </table>
            @endforeach
        </div>
        <div class="col img-thumbnail">
            <table>
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
                                <input type="number" class="form-control" value="{{ $cartItem->quantity }}" oninput="updateCartItemQuantity({{ $cartItem->id }}, this.value)">
                            </td>
                            <td class="total-price" data-product-price="{{ $cartItem->product->price * $cartItem->quantity }}">Rp {{ number_format($cartItem->quantity * $cartItem->product->price, 0, ',', '.') }}</td>
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
        </div>
    </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        @if (Session::has('success'))
        showSuccessMessage('<strong>{{ Session::get('success') }}</strong>');
        @endif

        @if (Session::has('error'))
        showErrorMessage('<strong>{{ Session::get('error') }}</strong>');
        @endif
    });

    function showSuccessMessage(message) {
        var successMessage = document.getElementById('success-message');
        successMessage.innerHTML = message;
        successMessage.style.display = 'block';

        setTimeout(function () {
            successMessage.style.display = 'none';
        }, 1500);
    }

    function showErrorMessage(message) {
        var errorMessage = document.getElementById('error-message');
        errorMessage.innerHTML = message;
        errorMessage.style.display = 'block';

        setTimeout(function () {
            errorMessage.style.display = 'none';
        }, 1500);
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Function to update the quantity of a cart item via AJAX
    function updateCartItemQuantity(cartItemId, newQuantity) {
    var data = {
        quantity: newQuantity,
        _token: "{{ csrf_token() }}"
    };

    $.ajax({
        type: "PATCH",
        url: "/cart/update-quantity/" + cartItemId,
        data: data,
        success: function (response) {
            console.log(response.message);

            if (response.updatedCartItem) {
                var cartItem = response.updatedCartItem;

                // Update kuantitas
                $("#cart-item-" + cartItem.id + " .form-control").val(cartItem.quantity);

                // Update total harga untuk item
                var totalPrice = cartItem.quantity * cartItem.product.price;
                $("#cart-item-" + cartItem.id + " .total-price").text("Rp " + numberWithCommas(totalPrice));

                // Update the data-product-price attribute with the new total price
                $("#cart-item-" + cartItem.id + " .total-price").data("product-price", totalPrice);

                // Recalculate total price after the update is successful
                recalculateTotalPrice();
            }
            updateCartCount();
        },
        error: function (error) {
            console.log("Error updating quantity: ", error.responseJSON.message);
            showErrorMessage("An error occurred while updating quantity.");
        }
    });
}

    function recalculateTotalPrice() {
        var total = 0;
        $(".total-price").each(function () {
            total += parseFloat($(this).data("product-price"));
        });

        $("#total-price").text(numberWithCommas(total));
    }
</script>

@endsection