<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutosSeeder extends Seeder
{
    public function run()
    {
        $produtos = [
            'Cafe',
            'Bolacha',
            'Leite',
            'Farinha',
            'Suco'
        ];
        foreach($produtos as $produto)
        {
            Produto::create([
                'nome' => $produto
            ]);
        }
    }
}
