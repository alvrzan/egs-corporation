<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function home()
    {
        $products = Product::all();
        // return response()->json(['products' => $products]);
        return view('pages/products', compact('products'));
    }
    public function index()
    {
        $products = Product::all();
        // return response()->json(['products' => $products]);
        return view('admin/products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['product' => $product]);
    }
    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($validatedData);

        return redirect()->route('products.index')->with(['message' => 'New Product Created', 'method' => 'create']);
    }
    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return view('/admin/products/edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Batasi tipe dan ukuran gambar
        ]);

        // Menggunakan Storage untuk menyimpan gambar ke direktori yang diinginkan
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images/products');

            // Mengupdate image_path di tabel images yang terhubung dengan produk ini
            $product->images()->update(['image_path' => Storage::url($imagePath)]);
        }

        // Hilangkan bidang 'id' dari data yang akan diupdate
        unset($validatedData['id']);

        $product->update($validatedData);

        return redirect()->route('products.index')->with(['message' => 'Product updated successfully', 'method' => 'update']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found');
        }

        $product->delete();

        return redirect()->route('products.index')->with(['message' => 'Product Deleted successfully', 'method' => 'destroy']);
    }
}
