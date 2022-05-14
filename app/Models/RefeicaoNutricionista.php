<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefeicaoNutricionista extends Model
{
    use HasFactory;

    protected $fillable = [
        'refeicao_id',
        'nutricionista_id'
    ];

    public function refeicao()
    {
        return $this->belongsTo(Refeicao::class);
    }
}
