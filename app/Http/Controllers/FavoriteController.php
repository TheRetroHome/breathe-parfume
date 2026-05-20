<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function index()
    {
        $favoriteIds = Favorite::where('user_id', auth()->id())->pluck('product_id');
        $products = Product::whereIn('id', $favoriteIds)
            ->where('is_active', true)
            ->with('notes')
            ->get();

        return view('favorites.index', compact('products'));
    }

    public function toggle(Product $product)
    {
        $existing = Favorite::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $added = false;
        } else {
            Favorite::create(['user_id' => auth()->id(), 'product_id' => $product->id]);
            $added = true;
        }

        $favCount = Favorite::where('user_id', auth()->id())->count();

        if (request()->expectsJson()) {
            return response()->json(['added' => $added, 'count' => $favCount]);
        }

        return back()->with('success', $added ? 'Добавлено в избранное.' : 'Удалено из избранного.');
    }
}
