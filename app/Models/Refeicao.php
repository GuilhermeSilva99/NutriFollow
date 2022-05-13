<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refeicao extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia_da_semana', 'descricao_refeicao', 'caloria', 'horario', 'nome_refeicao',
        'data', 'foto', 'observacoes', "paciente_id", "dieta_id", "nutricionista_id"
    ];

    public function dieta()
    {
        return $this->belongsTo(Dieta::class);
    }
}
