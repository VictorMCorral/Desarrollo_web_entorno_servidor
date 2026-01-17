<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table = "products";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        "name", 
        "description", 
        "price", 
        "available", 
        "product_type", 
        "image", 
        "date", 
        "pick_up"];
}
