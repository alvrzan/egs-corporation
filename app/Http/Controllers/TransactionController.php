<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function home()
    {
        $trans = Transaction::all();
        // return response()->json(['products' => $products]);
        return view('pages/products', compact('products'));
    }
    public function index()
    {
        $trans = Transaction::all();
        return view('admin/view/transactions', compact('trans'));
    }


    public function show($id)
    {
        $trans = Transaction::find($id);

        if (!$trans) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['trans' => $trans]);
    }
    public function create()
    {
        return view('admin.trans.create');
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'price' => 'required|numeric',
        // ]);

        // $product = Transaction::create($validatedData);

        // return redirect()->route('products.index')->with(['message' => 'New Product Created', 'method' => 'create']);
    }
    public function edit($id)
    {
        // $product = Transaction::find($id);

        // if (!$product) {
        //     return response()->json(['error' => 'Product not found'], 404);
        // }

        // return view('/admin/products/edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // $trans = Transaction::find($id);

        // if (!$trans) {
        //     return response()->json(['error' => 'Product not found'], 404);
        // }

        // $validatedData = $request->validate([
        //     'name' => 'string|max:255',
        //     'description' => 'string',
        //     'price' => 'numeric',
        //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Batasi tipe dan ukuran gambar
        // ]);

        // // Menggunakan Storage untuk menyimpan gambar ke direktori yang diinginkan
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('public/images/products');

        //     // Mengupdate image_path di tabel images yang terhubung dengan produk ini
        //     $product->images()->update(['image_path' => Storage::url($imagePath)]);
        // }

        // // Hilangkan bidang 'id' dari data yang akan diupdate
        // unset($validatedData['id']);

        // $product->update($validatedData);

        // return redirect()->route('products.index')->with(['message' => 'Product updated successfully', 'method' => 'update']);
    }

    public function destroy($id)
    {
        // $product = Transaction::find($id);

        // if (!$product) {
        //     return redirect()->route('products.index')->with('error', 'Product not found');
        // }

        // $product->delete();

        // return redirect()->route('products.index')->with(['message' => 'Product Deleted successfully', 'method' => 'destroy']);
    }
}
