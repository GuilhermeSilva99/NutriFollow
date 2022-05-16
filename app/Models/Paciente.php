<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nutricionista_id',
        'observacoes',
        'sexo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sono()
    {
        return $this->hasMany(Sono::class);
    }

    public function consumoAgua()
    {
        return $this->hasMany(ConsumoAgua::class);
    }

    public function comorbidades()
    {
        return $this->hasMany(Comorbidade::class);
    }

    public function exames()
    {
        return $this->hasMany(Exame::class);
    }

    public function suplementos(){
        return $this->hasMany(Suplemento::class);
    }

    public function medida()
    {
        return $this->hasMany(Medida::class);
    }
}
