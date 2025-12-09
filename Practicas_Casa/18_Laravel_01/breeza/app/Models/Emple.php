<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emple extends Model
{
    //protected $table = "emples";

    protected $primaryKey = 'emple_no';
    public $incrementing = false;

    protected $fillable = ["emple_no", "apellido", "oficio", "dir", "fecha_alt", "salario", "comision", "depart_no"];

    public function depart(){
        return $this->belonsTo(Depart::class, "depart_no");
    }

    public function director(){
        return $this->belongsTo(Emple::class, "dir");
    }
    
    public function empleados(){
        return $this->hasMany(Emple::class, "emple_no");
    }
}
