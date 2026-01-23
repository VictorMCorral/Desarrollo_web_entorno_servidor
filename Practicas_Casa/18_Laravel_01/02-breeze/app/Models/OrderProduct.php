<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = "orders_items";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        "order_id",
        "product_id",
        "quantity",
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
