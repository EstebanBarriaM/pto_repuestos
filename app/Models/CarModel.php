<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'slug',
        'car_brand_id'
    ];

    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class);
    }

    // many to many relation
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
