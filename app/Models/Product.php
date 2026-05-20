<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'brand', 'short_description', 'description',
        'gender', 'price', 'old_price', 'volume_ml', 'main_image', 'stock',
        'views', 'orders_count', 'rating', 'reviews_count', 'is_new',
        'is_bestseller', 'is_active', 'concentration', 'country',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'rating' => 'decimal:2',
        'is_new' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_active' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function notes()
    {
        return $this->belongsToMany(Note::class, 'product_note');
    }

    public function topNotes()
    {
        return $this->belongsToMany(Note::class, 'product_note')
            ->whereIn('notes.id', Note::where('type', 'top')->pluck('id'));
    }

    public function heartNotes()
    {
        return $this->belongsToMany(Note::class, 'product_note')
            ->whereIn('notes.id', Note::where('type', 'heart')->pluck('id'));
    }

    public function baseNotes()
    {
        return $this->belongsToMany(Note::class, 'product_note')
            ->whereIn('notes.id', Note::where('type', 'base')->pluck('id'));
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->old_price && $this->old_price > $this->price) {
            return round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return null;
    }
}
