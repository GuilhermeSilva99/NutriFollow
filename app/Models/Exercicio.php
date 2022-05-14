<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;

    protected $fillable = ["tipo", "duracao", "descricao", "data", "observacoes", "paciente_id", "tipo_exercicio_id"];

    public function tipoExercicio()
    {
        return $this->belongsTo(TipoExercicio::class);
    }
}
