<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;

    protected $fillable = [ 
        "altura", 
        "peso", 
        "cintura", 
        "biceps", 
        "ombro", 
        "triceps", 
        "peito", 
        "coxa", 
        "panturrilha", 
        "quadril", 
        "data", 
        "paciente_id"];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
