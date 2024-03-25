<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DepartamentoUsuario;
use App\Models\Departamento;
use App\Models\User;

class DepartamentoUsuariosSeeder extends Seeder
{
    public function run()
    {
        DepartamentoUsuario::create([
            'user_id' => '1',
            'departamento_id' => '1',
        ]);

        DepartamentoUsuario::create([
            'user_id' => '2',
            'departamento_id' => '2',
        ]);

        DepartamentoUsuario::create([
            'user_id' => '3',
            'departamento_id' => '3',
        ]);

        DepartamentoUsuario::create([
            'user_id' => '4',
            'departamento_id' => '4',
        ]);

        DepartamentoUsuario::create([
            'user_id' => '5',
            'departamento_id' => '1',
        ]);
    }
}
