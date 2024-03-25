<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'departamento_usuarios',
            'departamento_id',
            'user_id'
        );
    }

    public function sorteio()
    {
        return $this->hasMany(
        Sorteio::class, 
        'departamento_id', 
        'id'
        );
    }

    public function produtos()
    {
        return $this->belongsToMany(
            Produto::class,
            'departamento_produtos',
            'departamento_id',
            'produto_id'
        );
    }
}
