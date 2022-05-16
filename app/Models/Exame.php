<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    use HasFactory;

    protected $fillable = ["nome", "descricao", "data_realizacao", "paciente_id"];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
