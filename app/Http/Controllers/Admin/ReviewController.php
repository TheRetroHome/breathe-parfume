<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user', 'product')
            ->latest()
            ->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(Review $review)
    {
        $review->update(['is_approved' => !$review->is_approved]);

        // Recalculate product rating
        $product = $review->product;
        $avgRating = Review::where('product_id', $product->id)->where('is_approved', true)->avg('rating');
        $reviewsCount = Review::where('product_id', $product->id)->where('is_approved', true)->count();
        $product->update(['rating' => round($avgRating ?? 0, 2), 'reviews_count' => $reviewsCount]);

        return back()->with('success', 'Статус отзыва обновлён.');
    }

    public function destroy(Review $review)
    {
        $product = $review->product;
        $review->delete();

        $avgRating = Review::where('product_id', $product->id)->where('is_approved', true)->avg('rating');
        $reviewsCount = Review::where('product_id', $product->id)->where('is_approved', true)->count();
        $product->update(['rating' => round($avgRating ?? 0, 2), 'reviews_count' => $reviewsCount]);

        return back()->with('success', 'Отзыв удалён.');
    }
}
