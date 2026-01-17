<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders_items extends Model
{
    protected $table = "orders_items";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        "order_id",
        "product_id",
        "quantity",
        "unit_price"
    ];
}
