<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    // Lista de Atributos
    protected $fillable = ['name'];

    public function products() 
    {
        return $this->belongsToMany(Product::class);
    } 
}
