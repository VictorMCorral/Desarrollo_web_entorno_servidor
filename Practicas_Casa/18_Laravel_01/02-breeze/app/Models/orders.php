<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = "orders";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        "user_id",
        "status",
        "total",
    ];

    public function items()
    {
        return $this->hasMany(orders_items::class, 'order_id');

    }
}
