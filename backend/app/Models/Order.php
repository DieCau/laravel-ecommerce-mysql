<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Lista de atributos 
    protected $fillable = [
        'quantity', 
        'total', 
        'delivered_at', 
        'user_id', 
        'coupon_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function coupon()
    {
        return $this->belongsToMany(Coupon::class);
    }
}
