<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
    
        foreach ($products as $product) {
            Image::factory()
                ->count(3)
                ->state(['product_id' => $product->id])
                ->create();
        }
    }
    
}
