<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Lista de atributos
    protected $fillable = [
        'title', 
        'body', 
        'user_id', 
        'approved', 
        'rating', 
        'product_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getCreateAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
