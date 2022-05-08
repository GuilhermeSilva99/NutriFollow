<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'data_inicio',
        'data_fim',
        'paciente_id'
    ];

    public function refeicao()
    {
        return $this->hasMany(Refeicao::class);
    }
}
