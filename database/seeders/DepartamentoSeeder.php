<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario;

class DepartamentoSeeder extends Seeder
{
    public function run()
    {

        $departamento = array(
            'ASCOM',
            'DDS',
            'Infra',
            'Manutenção',
        );

        foreach ($departamento as $departamentos) {
            Departamento::create([
                'nome' => $departamentos
            ]);
        }
    }
}
