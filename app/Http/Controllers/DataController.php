<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function showProducts()
    {
        $products = Product::all(); // Ambil semua data produk dari database
        return view('admin/product', compact('products')); // Kirim data produk ke tampilan
    }
}
