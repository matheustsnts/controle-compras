<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sorteio extends Model
{
    use HasFactory;

    protected $fillable = [
        'departamento_id',
        'user_id',
        'produto_id',
        'status',
    ];


    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produto() {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
    

}
