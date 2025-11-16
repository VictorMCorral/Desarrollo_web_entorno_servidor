<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depart extends Model {
    protected $table = "depart";

    protected $primaryKey = "dept_no";

    public $timestamps = false;

    protected $fillable = ["dept_no", "dnombre", "loc"];

}
