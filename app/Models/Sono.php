<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sono extends Model
{
    use HasFactory;

    protected $fillable = ["data", "duracao", "avaliacao", "paciente_id"];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
