<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UsersSeeder extends Seeder
{

    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $nivel_1 = Permission::create(['name' => 'nivel-1']);
        $nivel_2 = Permission::create(['name' => 'nivel-2']);
        $nivel_3 = Permission::create(['name' => 'nivel-3']);
        $nivel_4 = Permission::create(['name' => 'nivel-4']);

        User::create([
            'name' => 'Admin ASCOM',
            'email' => 'admin@ascom.br',
            'password' => bcrypt('123456789'),
            'admin' => true,
            'nivel' => $nivel_1['name'],
        ])->givePermissionTo($nivel_1);

        User::create([
            'name' => 'Admin DDS',
            'email' => 'admin@dds.br',
            'password' => bcrypt('123456789'),
            'admin' => true,
            'nivel' => $nivel_2['name'],
        ])->givePermissionTo($nivel_2);

        User::create([
            'name' => 'Admin Infra',
            'email' => 'admin@infra.br',
            'password' => bcrypt('123456789'),
            'admin' => true,
            'nivel' => $nivel_3['name'],
        ])->givePermissionTo($nivel_3);

        User::create([
            'name' => 'Admin Suporte',
            'email' => 'admin@suporte.br',
            'password' => bcrypt('123456789'),
            'admin' => true,
            'nivel' => $nivel_4['name'],
        ])->givePermissionTo($nivel_4);

        User::create([
            'name' => 'Matheus',
            'email' => 'matheus@teste.com',
            'password' => bcrypt('123456789'),
            'admin' => true
        ]);

        User::factory(5)->create();
    }
}
