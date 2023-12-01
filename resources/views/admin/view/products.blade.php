@extends('admin.panel')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>

    @if(session('message'))
    <div class="alert {{ session('method') === 'update' ? 'alert-success' : (session('method') === 'create' ? 'alert-primary' : 'alert-danger') }}">
        {{ session('message') }}
    </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Produk Baru</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <button type="button" class="btn btn-danger delete-product" data-id="{{ $product->id }}">Hapus</button>
                    </div>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Konfirmasi Hapus -->
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"> <!-- Gunakan class "modal-dialog-centered" untuk meletakkannya di tengah -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-center" id="deleteConfirmationModalLabel">Konfirmasi Hapus Produk</h5>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus produk ini?
            </div>
            <div class="modal-footer justify-content-center"> <!-- Gunakan class "justify-content-center" untuk mengatur tombol ke tengah -->
                <form id="deleteProductForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                </div>
        </div>
    </div>
</div>

@endsection

<script>
    // Menggunakan JavaScript untuk menangani konfirmasi penghapusan
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.delete-product');
        var deleteForm = document.getElementById('deleteProductForm');
        var modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal')); // Mendefinisikan modal di sini

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var productId = button.getAttribute('data-id');

                modal.show();

                // Set action form penghapusan ke URL yang sesuai dengan produk yang dipilih
                deleteForm.action = '/products/' + productId;
            });
        });
        
    });
</script>
