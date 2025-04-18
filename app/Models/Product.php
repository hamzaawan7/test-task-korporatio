<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock_quantity',
        'image',
        'is_active'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }
}
