<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Orders/History', [
            'orders' => Order::with('items.product')
                ->where('user_id', Auth::id())
                ->latest()
                ->get(),
        ]);
    }

    public function adminIndex()
    {
        return Inertia::render('Admin/Orders/Index', [
            'orders' => Order::with(['user', 'items.product'])
                ->latest()
                ->get(),
        ]);
    }

    public function checkout(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $order = DB::transaction(function () use ($cart) {
            $productIds = collect($cart)->pluck('id');
            $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

            $total = collect($cart)->sum(function ($item) use ($products) {
                $product = $products->get($item['id']);

                abort_if(! $product || $product->stock < $item['quantity'], 422, 'Stok produk tidak cukup.');

                return $product->price * $item['quantity'];
            });

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                $product = $products->get($item['id']);

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            return $order;
        });

        $request->session()->forget('cart');

        return redirect()->route('orders.index');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,selesai'],
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index');
    }
}
