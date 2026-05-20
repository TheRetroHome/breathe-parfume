<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with('notes', 'category');

        // Gender filter
        if ($request->filled('gender')) {
            $query->whereIn('gender', (array) $request->gender);
        }

        // Note filter
        if ($request->filled('notes')) {
            $noteIds = (array) $request->notes;
            $productIds = \DB::table('product_note')
                ->whereIn('note_id', $noteIds)
                ->pluck('product_id')
                ->unique();
            $query->whereIn('id', $productIds);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereIn('category_id', (array) $request->category);
        }

        // Price filter
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Search
        if ($request->filled('q')) {
            $search = $request->q;
            $noteIds = Note::where('name', 'like', "%{$search}%")->pluck('id');
            $productIdsByNote = \DB::table('product_note')
                ->whereIn('note_id', $noteIds)
                ->pluck('product_id')
                ->unique();

            $query->where(function ($q) use ($search, $productIdsByNote) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhereIn('id', $productIdsByNote);
            });
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        match ($sort) {
            'price_asc'  => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'rating'     => $query->orderByDesc('rating'),
            'popular'    => $query->orderByDesc('orders_count'),
            default      => $query->orderByDesc('created_at'),
        };

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        $notes = Note::all()->groupBy('type');

        return view('catalog.index', compact('products', 'categories', 'notes'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $product->increment('views');

        $noteIds = \DB::table('product_note')
            ->where('product_id', $product->id)
            ->pluck('note_id');

        $notes = Note::whereIn('id', $noteIds)->get()->groupBy('type');

        $reviews = $product->reviews()->with('user')->latest()->paginate(10);

        $relatedIds = \DB::table('product_note')
            ->whereIn('note_id', $noteIds)
            ->where('product_id', '!=', $product->id)
            ->pluck('product_id')
            ->unique()
            ->take(20);

        $related = Product::whereIn('id', $relatedIds)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        $userReview = null;
        if (auth()->check()) {
            $userReview = \App\Models\Review::where('product_id', $product->id)
                ->where('user_id', auth()->id())
                ->first();
        }

        $userFavorite = false;
        if (auth()->check()) {
            $userFavorite = \App\Models\Favorite::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->exists();
        }

        return view('catalog.show', compact('product', 'notes', 'reviews', 'related', 'userReview', 'userFavorite'));
    }
}
