<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'is_active',
        'description',
    ];  
    protected $casts=[
        'image'=> 'array',
        'is_active'=> 'boolean',

    ];
    public function products(){
        return $this->hasMany(Product::class);
    }


}
