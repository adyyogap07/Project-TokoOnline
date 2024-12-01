<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transactions_id', 
        'products_id',
        'price',
        'shipping_status',
        'resi',
        'code'
    ];

    protected $hidden = [];

    /**
     * Relasi ke model Product
     * TransactionDetail (many) -> Product (one)
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    /**
     * Relasi ke model Transaction
     * TransactionDetail (many) -> Transaction (one)
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }
}
