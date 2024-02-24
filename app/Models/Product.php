<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category_id',
        'product_brand_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productBrand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    // many to many relation
    public function carModels()
    {
        return $this->belongsToMany(CarModel::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function mainImage()
    {
        $image = $this->productImages()->oldest()->first();
        return Storage::url($image->name);
    }
}
