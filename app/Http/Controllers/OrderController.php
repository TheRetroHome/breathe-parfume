<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('orders.show', compact('order'));
    }

    public function create()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('orders.create', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:30',
            'address'        => 'required|string|max:1000',
            'comment'        => 'nullable|string|max:1000',
            'payment_method' => 'required|in:cash,card',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        DB::transaction(function () use ($request, $cartItems, $total) {
            $order = Order::create([
                'user_id'        => auth()->id(),
                'status'         => 'pending',
                'total'          => $total,
                'name'           => $request->name,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'comment'        => $request->comment,
                'payment_method' => $request->payment_method,
            ]);

            $items = $cartItems->map(fn($item) => [
                'order_id'     => $order->id,
                'product_id'   => $item->product_id,
                'quantity'     => $item->quantity,
                'price'        => $item->product->price,
                'product_name' => $item->product->name,
                'created_at'   => now(),
                'updated_at'   => now(),
            ])->toArray();

            OrderItem::insert($items);

            // Increment orders_count for each product
            $cartItems->each(fn($item) => $item->product->increment('orders_count', $item->quantity));

            Cart::where('user_id', auth()->id())->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Заказ успешно оформлен! Ожидайте подтверждения.');
    }
}
