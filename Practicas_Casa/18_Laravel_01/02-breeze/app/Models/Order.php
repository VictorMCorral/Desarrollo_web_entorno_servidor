<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        "user_id",
        "total",
        #Agregar fecha_recogida
    ];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
