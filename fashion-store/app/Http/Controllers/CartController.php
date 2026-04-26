<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $cartProductIds = array_keys($cart);

        return Inertia::render('Cart/Index', [
            'items' => array_values($cart),
            'recommendedProducts' => Product::query()
                ->when($cartProductIds, fn ($query) => $query->whereNotIn('id', $cartProductIds))
                ->where('stock', '>', 0)
                ->latest()
                ->take(4)
                ->get(),
        ]);
    }

    public function store(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        $item = $cart[$product->id] ?? [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => 0,
        ];

        $item['quantity']++;
        $cart[$product->id] = $item;
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $validated['quantity'];
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function destroy(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }
}
