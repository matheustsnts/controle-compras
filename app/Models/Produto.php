<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function departamentos()
    {
        return $this->belongsToMany(
            Departamento::class,
            'departamento_produtos',
            'produto_id',
            'departamento_id'
        );
    }
}
