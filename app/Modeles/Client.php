<?php

namespace App\Modeles;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    protected $casts   = ['phone' => 'array'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeSearch($q, $request)
    {
        return $q->when($request->search, function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%')->orWhere('address', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
        });
    }
}
