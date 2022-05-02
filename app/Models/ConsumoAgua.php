<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumoAgua extends Model
{
    use HasFactory;

    protected $fillable = ["data", "quantidade", "paciente_id"];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
