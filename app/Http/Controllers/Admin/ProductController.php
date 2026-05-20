<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Note;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $notes = Note::all()->groupBy('type');

        return view('admin.products.create', compact('categories', 'notes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'brand'             => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'short_description' => 'required|string|max:500',
            'description'       => 'required|string',
            'gender'            => 'required|in:male,female,unisex',
            'price'             => 'required|numeric|min:0',
            'old_price'         => 'nullable|numeric|min:0',
            'volume_ml'         => 'required|integer|min:1',
            'stock'             => 'required|integer|min:0',
            'concentration'     => 'nullable|string|max:100',
            'country'           => 'nullable|string|max:100',
            'is_new'            => 'boolean',
            'is_bestseller'     => 'boolean',
            'is_active'         => 'boolean',
            'main_image'        => 'required|image|max:5120',
            'notes'             => 'array',
            'notes.*'           => 'exists:notes,id',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_new'] = $request->boolean('is_new');
        $data['is_bestseller'] = $request->boolean('is_bestseller');
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        $product = Product::create($data);

        if ($request->filled('notes')) {
            $noteData = array_map(fn($id) => ['product_id' => $product->id, 'note_id' => $id, 'created_at' => now(), 'updated_at' => now()], $request->notes);
            \DB::table('product_note')->insert($noteData);
        }

        return redirect()->route('admin.products.index')->with('success', 'Товар успешно создан!');
    }

    public function show(string $id)
    {
        $product = Product::with('category', 'notes', 'images')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::with('notes', 'images')->findOrFail($id);
        $categories = Category::all();
        $notes = Note::all()->groupBy('type');
        $productNoteIds = \DB::table('product_note')->where('product_id', $id)->pluck('note_id')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'notes', 'productNoteIds'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'brand'             => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'short_description' => 'required|string|max:500',
            'description'       => 'required|string',
            'gender'            => 'required|in:male,female,unisex',
            'price'             => 'required|numeric|min:0',
            'old_price'         => 'nullable|numeric|min:0',
            'volume_ml'         => 'required|integer|min:1',
            'stock'             => 'required|integer|min:0',
            'concentration'     => 'nullable|string|max:100',
            'country'           => 'nullable|string|max:100',
            'is_new'            => 'boolean',
            'is_bestseller'     => 'boolean',
            'is_active'         => 'boolean',
            'main_image'        => 'nullable|image|max:5120',
            'notes'             => 'array',
            'notes.*'           => 'exists:notes,id',
        ]);

        $data['is_new'] = $request->boolean('is_new');
        $data['is_bestseller'] = $request->boolean('is_bestseller');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('main_image')) {
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('products', 'public');
        } else {
            unset($data['main_image']);
        }

        $product->update($data);

        \DB::table('product_note')->where('product_id', $product->id)->delete();
        if ($request->filled('notes')) {
            $noteData = array_map(fn($nid) => ['product_id' => $product->id, 'note_id' => $nid, 'created_at' => now(), 'updated_at' => now()], $request->notes);
            \DB::table('product_note')->insert($noteData);
        }

        return redirect()->route('admin.products.index')->with('success', 'Товар успешно обновлён!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Товар удалён.');
    }

    public function uploadImage(Request $request, Product $product)
    {
        $request->validate(['image' => 'required|image|max:5120']);

        $path = $request->file('image')->store('products', 'public');

        $image = ProductImage::create([
            'product_id' => $product->id,
            'image'      => $path,
            'sort_order' => ProductImage::where('product_id', $product->id)->max('sort_order') + 1,
        ]);

        return response()->json(['success' => true, 'image' => $image]);
    }

    public function deleteImage(Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) abort(403);

        Storage::disk('public')->delete($image->image);
        $image->delete();

        return response()->json(['success' => true]);
    }
}
