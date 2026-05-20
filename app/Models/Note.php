<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Note extends Model
{
    protected $fillable = ['name', 'slug', 'type', 'icon'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_note');
    }
}
