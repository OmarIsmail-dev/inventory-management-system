<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    // Tell Eloquent to use the 'orders' table instead of 'customer_orders'
    protected $table = 'orders';

    // Only fillable columns you want to mass-assign
    protected $fillable = [
        'id',
        'user_id',
        'email',
        'phone',
        'Address',
        'product_id',
        'image',
        'status',

    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}

