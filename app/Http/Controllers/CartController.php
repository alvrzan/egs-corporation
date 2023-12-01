<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function index()
    {
        // Pastikan pengguna sudah login
        if (Auth::check()) {
            // Ambil daftar produk yang ada di shopping-cart untuk pengguna yang terautentikasi
            $cartItems = CartItem::where('user_id', Auth::id())->get();

            if ($cartItems) {
                // Hitung total harga dari produk-produk dalam shopping-cart
                $totalPrice = $cartItems->sum(function ($item) {
                    return $item->quantity * $item->product->price;
                });
            } else {
                $cartItems = collect(); // Inisialisasi sebagai koleksi kosong jika $cartItems null
                $totalPrice = 0;
            }
        } else {
            // Jika pengguna belum login, inisialisasi $cartItems sebagai koleksi kosong
            $cartItems = collect();
            $totalPrice = 0;
        }

        // Menambahkan pesan jika keranjang belanja kosong
        $emptyCartMessage = $cartItems->isEmpty() ? 'Produk belum dipilih.' : '';

        // Mengembalikan view dengan data yang diperlukan
        return view('pages.cart', compact('cartItems', 'totalPrice', 'emptyCartMessage'));
    }

    public function addToCart(Request $request, $productId)
    {
        // Pastikan pengguna sudah login
        if (auth()->check()) {
            // Temukan produk berdasarkan ID
            $product = Product::find($productId);

            // Jika produk ditemukan
            if ($product) {
                // Cek apakah produk sudah ada di keranjang belanja pengguna
                $cartItem = CartItem::where('user_id', auth()->id())->where('product_id', $productId)->first();

                if ($cartItem) {
                    // Jika produk sudah ada di keranjang belanja, tambahkan jumlahnya
                    $cartItem->quantity += 1;
                    $cartItem->save();
                } else {
                    // Jika produk belum ada di keranjang belanja, tambahkan produk baru
                    $cartItem = new CartItem([
                        'user_id' => auth()->id(),
                        'product_id' => $productId,
                        'quantity' => 1,
                    ]);

                    $cartItem->save();
                }

                // Berikan respons sukses
                return redirect()->route('shopping-cart')->with('success', 'Produk berhasil ditambahkan ke keranjang belanja.');
            }
        }

        // Berikan respons gagal jika terjadi kesalahan
        return response()->json(['message' => 'Terjadi kesalahan. Produk tidak dapat ditambahkan ke keranjang belanja.'], 400);
    }

    public function updateQuantity(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid input.', 'errors' => $validator->errors()], 400);
        }

        try {
            $cartItem = CartItem::findOrFail($id);
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            // Update total harga produk pada baris yang diubah
            $totalPrice = $cartItem->quantity * $cartItem->product->price;

            return response()->json(['message' => 'Kuantitas berhasil diperbarui.', 'totalPrice' => $totalPrice, 'updatedCartItem' => $cartItem]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memperbarui kuantitas.'], 500);
        }
    }

    public function remove($id)
    {
        try {
            $cartItem = CartItem::findOrFail($id);
            $cartItem->delete();

            // Set pesan sukses ke session
            Session::flash('success', 'Item berhasil dihapus.');

            return redirect()->route('shopping-cart');
        } catch (\Exception $e) {
            // Set pesan error ke session
            Session::flash('error', 'Gagal menghapus item.');

            return redirect()->route('shopping-cart');
        }
    }



    public function getCartItemCount()
    {
        // Hitung jumlah item dalam keranjang Anda (gunakan sesuai dengan implementasi Anda).
        $cartItemCount = CartItem::where('user_id', Auth::id())->count();

        return response()->json(['count' => $cartItemCount]);
    }

    public function createTransaction(Request $request)
    {
        // Pastikan pengguna sudah login
        if (auth()->check()) {
            // Ambil daftar produk yang ada di keranjang belanja pengguna
            $cartItems = CartItem::where('user_id', auth()->id())->get();

            // Hitung total harga dari produk-produk dalam keranjang
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // Hitung jumlah produk dalam keranjang belanja
            $amountProduct = $cartItems->count();

            // Simpan transaksi ke dalam tabel transactions
            $transaction = new Transaction([
                'user_id' => auth()->id(),
                'amount_product' => $amountProduct,
                'total_price' => $totalPrice,
            ]);

            $transaction->save();

            // Menyimpan produk yang dibeli ke dalam transaksi (melalui relasi many-to-many)
            foreach ($cartItems as $cartItem) {
                $transaction->products()->attach($cartItem->product_id, ['quantity' => $cartItem->quantity]);
            }

            // Setelah transaksi berhasil dibuat, Anda dapat menghapus konten keranjang belanja pengguna
            CartItem::where('user_id', auth()->id())->delete();

            // Berikan respons sukses
            return redirect()->route('shopping-cart')->with('success', 'Transaksi berhasil dibuat.');
        }

        // Berikan respons gagal jika pengguna belum login
        return redirect()->route('login')->with('error', 'Anda harus login untuk membuat transaksi.');
    }
}
