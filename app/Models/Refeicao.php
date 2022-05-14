<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refeicao extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia_da_semana', 'descricao_refeicao', 'caloria', 'horario', 'nome_refeicao', 'data', "dieta_id"
    ];

    public function dieta()
    {
        return $this->belongsTo(Dieta::class);
    }
}
