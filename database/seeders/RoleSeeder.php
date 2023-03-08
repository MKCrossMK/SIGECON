<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Director',
            'Tecnologia',
            'Administrador',
            'Gerente',
            'Negocios',
            'Inspector',
            'Contabilidad',
            'Cajero',
            'Perito',
        ];

        foreach ($roles as $rol) {
            Role::create([
                'name' => $rol
            ]);
        }
    }
}
