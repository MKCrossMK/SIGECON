<?php

namespace Database\Seeders;

use App\Models\Cash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Cash::create([
            'name' => 'Caja 1, Sucursal 1',
            'branch_offices_id' => 1,
            'initial_amount' => 2000000,
            'balance' => 2000000,
        ]);

        Cash::create([
            'name' => 'Caja 1, Sucursal 2',
            'branch_offices_id' => 2,
            'initial_amount' => 2000000,
            'balance' => 2000000,
        ]);

        Cash::create([
            'name' => 'Caja 1, Sucursal 3',
            'branch_offices_id' => 3,
            'initial_amount' => 2000000,
            'balance' => 2000000,
        ]);
        Cash::create([
            'name' => 'Caja 1, Sucursal 4',
            'branch_offices_id' => 4,
            'initial_amount' => 2000000,
            'balance' => 2000000,
        ]);
        Cash::create([
            'name' => 'Caja 1, Sucursal 5',
            'branch_offices_id' => 5,
            'initial_amount' => 2000000,
            'balance' => 2000000,
        ]);
        Cash::create([
            'name' => 'Caja 1, Sucursal 6',
            'branch_offices_id' => 6,
            'initial_amount' => 2000000,
            'balance' => 2000000,
        ]);
    }
}

