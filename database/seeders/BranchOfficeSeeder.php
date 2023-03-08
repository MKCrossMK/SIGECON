<?php

namespace Database\Seeders;

use App\Models\Branch_Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Branch_Office::create([
            'name' => 'Ciudad Colonial',
            'sub_name' => 'Sucursal 1',
            'address' => 'C/ Mercedes, Nº 105',
            'province' => 'Santo Domingo',
            'phone' => '809-682-8831',
            'phone_ext' => '221',

        ]);

        Branch_Office::create([
            'name' => 'Teniente Amado (Duarte)',
            'sub_name' => 'Sucursal 2',
            'address' => 'C/ Teniente Amado Garcia, Esq. Juan Bautista Vicini, Villa Consuelo, Nº 185-187',
            'province' => 'Santo Domingo',
            'phone' => '809-682-5310',
            // 'phone_ext' => '',
        ]);

        Branch_Office::create([
            'name' => 'Las Carreras (Santiago de los caballeros)',
            'sub_name' => 'Sucursal 3',
            'address' => 'Av. Las carreras & calle Duarte',
            'province' => 'Santiago de los Caballeros',
            'phone' => '809-594-5959',
            // 'phone_ext' => '223',
        ]);

        Branch_Office::create([
            'name' => 'Rosa Duarte',
            'sub_name' => 'Sucursal 4',
            'address' => 'C/ Rosa Duarte Esq. Juan Pablo Duarte #122, Los Mina',
            'province' => 'Santo Domingo',
            'phone' => '809-594-5959',
            // 'phone_ext' => '223',
        ]);

        Branch_Office::create([
            'name' => 'V Centenario',
            'sub_name' => 'Sucursal 5',
            'address' => 'Av. Expreso V Centenario, Edif. 7, Villa Juana',
            'province' => 'Santo Domingo',
            'phone' => '809-536-0822',
            // 'phone_ext' => '223',
        ]);

        Branch_Office::create([
            'name' => 'Bartolome Olegatorio (Azua)',
            'sub_name' => 'Sucursal 6',
            'address' => 'C/ Bartolome Olegatorio #92-A, Sector La Placeta',
            'province' => 'Azua',
            'phone' => '809-521-4555',
            // 'phone_ext' => '223',
        ]);
    }
}
