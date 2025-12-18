<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emple extends Model
{
    //protected $table = "emples";

    protected $primaryKey = 'emple_no';
    public $incrementing = false;

    protected $fillable = ["emple_no", "apellido", "oficio", "dir", "fecha_alt", "salario", "comision", "depart_no", "foto"];

    public function depart(){
        return $this->belongsTo(Depart::class, "depart_no", "depart_no");
    }

    public function director(){
        return $this->belongsTo(Emple::class, "dir", "emple_no");
    }
    
    public function subordinados(){
        return $this->hasMany(Emple::class, "dir", "emple_no");
    }
}
