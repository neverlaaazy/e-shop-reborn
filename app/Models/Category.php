<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function products():HasMany
    {
        return $this->hasMany(Product::class)->orderBy('title');
    }

    public function productsWithPrice():HasMany
    {
        return $this->hasMany(Product::class)->where('price','>',10000);
    }
}
