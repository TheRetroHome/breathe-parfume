<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $bestsellers = Product::where('is_active', true)
            ->where('is_bestseller', true)
            ->with('notes')
            ->limit(8)
            ->get();

        $newArrivals = Product::where('is_active', true)
            ->where('is_new', true)
            ->with('notes')
            ->limit(8)
            ->get();

        $topRated = Product::where('is_active', true)
            ->where('reviews_count', '>', 0)
            ->orderByDesc('rating')
            ->with('notes')
            ->limit(6)
            ->get();

        $reviews = Review::where('is_approved', true)
            ->with('user', 'product')
            ->latest()
            ->limit(6)
            ->get();

        return view('home', compact('bestsellers', 'newArrivals', 'topRated', 'reviews'));
    }
}
