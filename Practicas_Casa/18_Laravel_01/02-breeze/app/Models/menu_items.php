<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu_items extends Model
{
    protected $table = "menu_items";

    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        "menu_id",
        "product_id",
        "category"
    ];
}
