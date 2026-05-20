<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Product;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        return view('quiz.index');
    }

    public function result(Request $request)
    {
        $answers = $request->input('answers', []);

        // Map answers to note slugs / genders / categories
        $genders   = [];
        $noteSlugs = [];

        if (!empty($answers['mood'])) {
            $noteSlugs = array_merge($noteSlugs, match($answers['mood']) {
                'fresh'   => ['bergamot', 'lemon', 'grapefruit', 'green-tea'],
                'warm'    => ['vanilla', 'sandalwood', 'amber', 'musk'],
                'floral'  => ['rose', 'jasmine', 'peony', 'lily'],
                'woody'   => ['cedarwood', 'vetiver', 'patchouli'],
                'spicy'   => ['black-pepper', 'cardamom', 'oud', 'cinnamon'],
                default   => [],
            });
        }

        if (!empty($answers['gender'])) {
            $genders = match($answers['gender']) {
                'male'   => ['male', 'unisex'],
                'female' => ['female', 'unisex'],
                default  => ['male', 'female', 'unisex'],
            };
        }

        if (!empty($answers['season'])) {
            $noteSlugs = array_merge($noteSlugs, match($answers['season']) {
                'spring' => ['rose', 'peony', 'lily', 'green-tea'],
                'summer' => ['bergamot', 'lemon', 'grapefruit', 'aqua'],
                'autumn' => ['patchouli', 'amber', 'cinnamon', 'sandalwood'],
                'winter' => ['oud', 'vanilla', 'musk', 'black-pepper'],
                default  => [],
            });
        }

        $query = Product::where('is_active', true)->with('notes', 'category');

        if ($genders) {
            $query->whereIn('gender', $genders);
        }

        if ($noteSlugs) {
            $noteIds = Note::whereIn('slug', $noteSlugs)->pluck('id');
            if ($noteIds->isNotEmpty()) {
                $productIds = \DB::table('product_note')
                    ->whereIn('note_id', $noteIds)
                    ->pluck('product_id')
                    ->unique();
                $query->whereIn('id', $productIds);
            }
        }

        $products = $query->orderByDesc('rating')->limit(3)->get();

        // Fallback: top rated products
        if ($products->isEmpty()) {
            $products = Product::where('is_active', true)
                ->with('notes', 'category')
                ->orderByDesc('rating')
                ->limit(3)
                ->get();
        }

        return view('quiz.result', compact('products', 'answers'));
    }
}
