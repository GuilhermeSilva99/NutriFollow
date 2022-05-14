<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comorbidade extends Model
{
    use HasFactory;

    protected $fillable = ["nome", "descricao", "data_diagnostico", "paciente_id"];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
