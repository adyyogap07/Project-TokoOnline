<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'products_id', 'users_id'
    ];

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
