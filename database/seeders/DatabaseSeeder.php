<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     DepartamentoSeeder::class,
        // ]);
        // $this->call(ProdutosSeeder::class);

        // $this->call(SorteiosSeeder::class);
        // $this->call(SorteadosSeeder::class);
        // $this->call(Departamento_ProdutosSeeder::class);
        // $this->call(DepartamentousuariosSeeder::class);
        // $this->call(Departamento_UsuariosSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(ProdutosSeeder::class);
        $this->call(DepartamentoUsuariosSeeder::class);
    }
}
