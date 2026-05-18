<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Category extends Model
{
    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->orderBy('title');
    }

    public function productsWithPrice(): HasMany
    {
        return $this->hasMany(Product::class)->where('price', '>', 10000);
    }

    public function getRouteKeyName(): string
    {
        return Schema::hasColumn($this->getTable(), 'slug') ? 'slug' : $this->getKeyName();
    }

    public function getRouteKey(): mixed
    {
        if (Schema::hasColumn($this->getTable(), 'slug') && $this->slug) {
            return $this->slug;
        }

        return $this->getKey();
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $field = $field ?: $this->getRouteKeyName();
        $query = static::query();

        if (Schema::hasColumn($this->getTable(), $field)) {
            $query->where($field, $value);
        }

        return $query->orWhere('id', $value)->first();
    }

    protected static function booted()
    {
        static::saving(function ($category) {
            $slug = Str::slug($category->title);
            $query = static::where('slug', 'like', $slug . '%');

            if ($category->exists) {
                $query->where('id', '<>', $category->id);
            }

            $count = $query->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $category->slug = $slug;
        });
    }
}
