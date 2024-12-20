<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['name', 'slug', 'quantity', 'price', 'desc', 'thumbnail', 'first_image', 'second_image', 'third_image', 'status'];

    public function colors() 
    {
        return $this->belongsToMany(Color::class);
    }
    
    public function sizes() 
    {
        return $this->belongsToMany(Size::class);
    }
    
    public function orders() 
    {
        return $this->belongsToMany(Order::class);
    }
    
    public function reviews() 
    {
        return $this->hasMany(Review::class)
        ->with('user')
        ->where('approved', 1)
        ->latest();
    }

    public function getRouteKeyName()
    {
        return 'slug';        
    }

}
