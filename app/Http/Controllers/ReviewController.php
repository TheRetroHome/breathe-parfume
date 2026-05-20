<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title'  => 'nullable|string|max:255',
            'body'   => 'required|string|min:10|max:2000',
        ]);

        $existing = Review::where('product_id', $product->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return back()->with('error', 'Вы уже оставили отзыв на этот товар.');
        }

        Review::create([
            'product_id'  => $product->id,
            'user_id'     => auth()->id(),
            'rating'      => $request->rating,
            'title'       => $request->title,
            'body'        => $request->body,
            'is_approved' => true,
        ]);

        // Recalculate product rating
        $avgRating = Review::where('product_id', $product->id)
            ->where('is_approved', true)
            ->avg('rating');

        $reviewsCount = Review::where('product_id', $product->id)
            ->where('is_approved', true)
            ->count();

        $product->update([
            'rating'        => round($avgRating, 2),
            'reviews_count' => $reviewsCount,
        ]);

        return back()->with('success', 'Отзыв успешно добавлен!');
    }
}
