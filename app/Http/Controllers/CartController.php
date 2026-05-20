<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate(['quantity' => 'integer|min:1|max:99']);

        $qty = $request->integer('quantity', 1);

        $existing = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->increment('quantity', $qty);
        } else {
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'quantity'   => $qty,
            ]);
        }

        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'cart_count' => $cartCount]);
        }

        return back()->with('success', 'Товар добавлен в корзину!');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:99']);

        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Корзина обновлена.');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Товар удалён из корзины.');
    }
}
