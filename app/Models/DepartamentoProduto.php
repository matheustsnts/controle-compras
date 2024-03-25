<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentoProduto extends Model
{
    use HasFactory;

    protected $fillable = [

        'departamento_id',
        'produto_id',
    ];

    public function departamento()
    {
        return $this->belongTo(Departamento::class, 'departamento_id','id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id','id');
    }
}
