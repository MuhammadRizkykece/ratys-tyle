<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use App\Models\ProductVariant;
use App\Models\Review;

class Product extends Model
{
    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'slug',
        'sku',
        'image',
        'description',
        'price',
        'sale_price',
        'stock',
        'weight',
        'featured',
        'status',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {

            if (!$product->slug) {
                $product->slug = Str::slug($product->name);
            }
        });


        static::updating(function ($product) {

            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }



    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)
            ->orderBy('sort_order');
    }
}
