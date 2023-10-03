<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_product', 'product_id', 'transaction_id')
            ->withPivot('quantity') // Opsional jika ingin menyimpan jumlah produk
            ->withTimestamps();
    }
}
