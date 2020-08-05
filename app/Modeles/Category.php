<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeSearch($q, $request)
    {
        return $q->whereHas('translations', function ($q) use ($request) {
            return $q->when($request->search, function ($quary) use ($request) {
                return $quary->where('name', 'like', '%' . $request->search . '%');
            });
        });
    }
}
