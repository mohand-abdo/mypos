<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
    }

    public function scopeSearch($q, $request)
    {
        return $q->whereHas('client', function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
        });
    }
}
