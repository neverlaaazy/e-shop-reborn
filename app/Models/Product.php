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

    protected static function booted()
    {
        static::saving(function($product){
            $product->slug = Str::slug($product->title);
            $count = static::where('slug', 'like', $product->slug."%")->count();
            if($count > 0){
                $product->slug .= '-'.($count+1);
            }
        });
    }

}
