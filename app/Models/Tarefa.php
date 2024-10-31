<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'custo',
        'data_limite',
        'ordem',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('ordenado', function ($query) {
            $query->orderBy('ordem');
        });
    }
}
