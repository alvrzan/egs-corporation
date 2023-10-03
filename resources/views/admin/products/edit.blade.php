@extends('admin.panel')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Harga:</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <!-- Menampilkan gambar produk dari tabel 'images' jika ada -->
        @if ($product->images->count() > 0)
            <div class="form-group">
                <label for="current_image">Gambar Saat Ini:</label>
                <img src="{{ asset($product->images[0]->image_path) }}" alt="Product Image" class="img-thumbnail">
            </div>
        @else
            <p>Gambar produk tidak tersedia.</p>
        @endif

        <div class="form-group">
            <label for="image">Gambar Baru:</label>
            <input type="file" name="image" class="form-control-file" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
