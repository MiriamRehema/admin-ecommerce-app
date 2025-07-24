<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'name',
        'slug',
        'description',
        'image',
        'price',
        'is_active',
        'category_id',
        'stock',
        'is_featured',
        'is_new',
        'is_on_sale',
        'sale_price'
    ];
    protected $casts = [
        'image' => 'array',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_on_sale' => 'boolean',
    ];
}
