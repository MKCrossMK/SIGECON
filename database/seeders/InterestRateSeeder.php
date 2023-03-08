<?php

namespace Database\Seeders;

use App\Models\InterestRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InterestRate::create([
            'description' => 'first',
            'porcent' => 4.0
        ]);

        InterestRate::create([
            'description' => 'second',
            'porcent' => 3.0
        ]);

        InterestRate::create([
            'description' => 'preference',
            'porcent' => 2.5
        ]);


    }
}
