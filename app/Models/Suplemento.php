<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplemento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'quantidade',
        'data_inicio',
        'data_fim',
        'paciente_id'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

}