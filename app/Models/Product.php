<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes, HasFactory;
    
    public $fillable = [
        'title',
        'price',
        'description',
        'category_id',
        'path_img'
    ];
    //public $guarded = [];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->path_img) {
            return '';
        }

        return preg_match('/^https?:\/\//', $this->path_img)
            ? $this->path_img
            : asset($this->path_img);
    }

    protected static function booted()
    {
        static::saving(function ($product) {
            $slug = Str::slug($product->title);
            $query = static::where('slug', 'like', $slug . '%');

            if ($product->exists) {
                $query->where('id', '<>', $product->id);
            }

            $count = $query->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $product->slug = $slug;
        });
    }

}
