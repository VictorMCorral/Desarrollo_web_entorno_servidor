<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        "name",
        "description",
        "price",
        "image",
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function offers()
    {
        return $this->belongstoMany(Offer::class);


    }
}
