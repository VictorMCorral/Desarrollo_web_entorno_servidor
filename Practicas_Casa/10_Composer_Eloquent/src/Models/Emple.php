<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emple extends Model {
    protected $table = "emple";

    protected $primaryKey = "emple_no";

    public $timestamps = false;

    protected $fillable = ["emple_no", "apellido", "oficio", "dept_no"];

}
