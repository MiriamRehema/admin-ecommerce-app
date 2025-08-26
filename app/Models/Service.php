<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'service';

    protected $fillable=[
        'name',
        'slug',
        'description',
        'price',
        'image',
        'is_active',
        

    ];
    protected $casts=[
        'image'=> 'array'

    ];
    
    public function reviews(){
        return $this->belongsToMany(Review::class);
    }
    public function order_services(){
        return $this->hasMany(Order_service::class);
    }
    
}
