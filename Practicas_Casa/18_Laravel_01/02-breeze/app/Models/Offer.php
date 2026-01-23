<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        "date_delivery",
        "time_delivery",
        "dtetime_limit",
    ];


    public function products()
    {
        return $this->belongstoMany(Product::class
        ,
            "offers_products",
            "offer_id",
            "product_id");
    }
}
