<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name', 'desc'];

    protected $appends = ['image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('quantity');
    }

    public function getImagePathAttribute()
    {
        return asset('dashboard_files/assets/upload/product_images/' . $this->image);
    }

    public function scopeSearch($q, $request)
    {
        return $q->whereHas('translations', function ($q) use ($request) {
            return $q->when($request->search, function ($quary) use ($request) {
                return $quary->where('name', 'like', '%' . $request->search . '%');
            });
        })->when($request->category_id, function ($qu) use ($request) {
            return $qu->where('category_id', $request->category_id);
        });
    }
}
