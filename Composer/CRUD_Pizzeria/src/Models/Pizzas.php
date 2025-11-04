<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizzas extends Model {
    protected $table = "pizzas";

    public $timestamps = false;

    protected $fillable = ["nombre", "ingredientes", "alergenos", "precio"];

}
