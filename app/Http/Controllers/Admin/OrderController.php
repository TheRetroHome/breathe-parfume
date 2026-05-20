<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
            ->when(request('status'), fn($q) => $q->where('status', request('status')))
            ->latest()
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'admin_note' => 'nullable|string|max:1000',
        ]);

        $order->update(['admin_note' => $request->admin_note]);

        return back()->with('success', 'Заметка сохранена.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Статус заказа обновлён.');
    }

    public function create() { abort(404); }
    public function store(Request $request) { abort(404); }
    public function edit(string $id) { abort(404); }
    public function destroy(string $id) { abort(404); }
}
