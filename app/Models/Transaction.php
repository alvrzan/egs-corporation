<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount_product',
        'total_price',
        // Tambahkan kolom lainnya sesuai kebutuhan Anda
    ];

    // Definisikan relasi dengan tabel lain jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_product', 'transaction_id', 'product_id')
            ->withPivot('quantity') // Opsional jika ingin menyimpan jumlah produk
            ->withTimestamps();
    }
}
