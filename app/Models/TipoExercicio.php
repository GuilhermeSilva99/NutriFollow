<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoExercicio extends Model
{
    use HasFactory;

    protected $fillable = ["nome"];

    public function exercicio()
    {
        return $this->belongsToMany(Exercicio::class);
    }
}
