<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class StorefrontController extends Controller
{
    public function home()
    {
        return Inertia::render('Storefront/Home', [
            'products' => Product::latest()->get(),
        ]);
    }

    public function show(Product $product)
    {
        return Inertia::render('Storefront/ProductShow', [
            'product' => $product,
        ]);
    }
}
