<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    
    protected $fillable = [
        'photos',
        'products_id'
    ];

    // Perbaiki relasi - sesuaikan dengan nama kolom di database
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}

