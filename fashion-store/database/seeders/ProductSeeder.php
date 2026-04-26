<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->delete();

        $products = [
            [
                'name' => 'Classic White Tee',
                'description' => 'Kaos putih klasik dengan bahan katun lembut dan potongan modern yang bersih. Cocok untuk gaya sehari-hari yang simpel dan elegan.',
                'price' => 149000,
                'stock' => 24,
                'image' => '/images/1.jpg',
            ],
            [
                'name' => 'Navy Stripe Shirt',
                'description' => 'Kemeja bergaris navy yang sempurna untuk layering sehari-hari. Terbuat dari bahan berkualitas tinggi dengan desain klasik.',
                'price' => 199000,
                'stock' => 18,
                'image' => '/images/2.jpg',
            ],
            [
                'name' => 'Black Graphic Tee',
                'description' => 'Kaos grafis hitam dengan cetakan bold yang cocok untuk gaya streetwear. Terbuat dari bahan katun yang nyaman dipakai.',
                'price' => 169000,
                'stock' => 12,
                'image' => '/images/3.jpg',
            ],
            [
                'name' => 'Slim Fit Jeans',
                'description' => 'Celana jeans slim fit dengan bahan denim stretch yang nyaman. Potongan ramping yang cocok untuk berbagai acara.',
                'price' => 299000,
                'stock' => 16,
                'image' => '/images/4.jpg',
            ],
            [
                'name' => 'Relaxed Denim Pants',
                'description' => 'Celana denim relaxed fit dengan wash vintage yang stylish. Nyaman untuk aktivitas sehari-hari dengan gaya kasual.',
                'price' => 329000,
                'stock' => 10,
                'image' => '/images/5.jpg',
            ],
            [
                'name' => 'Charcoal Cargo Jeans',
                'description' => 'Celana cargo jeans charcoal dengan kantong utility yang fungsional. Desain praktis untuk gaya urban modern.',
                'price' => 349000,
                'stock' => 8,
                'image' => '/images/6.jpg',
            ],
            [
                'name' => 'White Leather Sneakers',
                'description' => 'Sepatu sneakers kulit putih minimalis dengan kualitas premium. Cocok untuk gaya kasual yang elegan.',
                'price' => 499000,
                'stock' => 14,
                'image' => '/images/7.jpg',
            ],
            [
                'name' => 'Retro Running Shoes',
                'description' => 'Sepatu lari bergaya retro dengan bantalan empuk yang nyaman. Desain klasik dengan teknologi modern.',
                'price' => 459000,
                'stock' => 9,
                'image' => '/images/8.jpg',
            ],
            [
                'name' => 'Aviator Sunglasses',
                'description' => 'Kacamata hitam aviator dengan frame logam yang dipoles. Lensa tinted untuk perlindungan mata yang optimal.',
                'price' => 219000,
                'stock' => 20,
                'image' => '/images/9.jpg',
            ],
            [
                'name' => 'Lightweight Bomber Jacket',
                'description' => 'Jaket bomber ringan yang serbaguna untuk malam yang sejuk. Desain modern dengan bahan berkualitas tinggi.',
                'price' => 399000,
                'stock' => 6,
                'image' => '/images/10.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
