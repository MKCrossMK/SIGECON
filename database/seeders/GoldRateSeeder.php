<?php

namespace Database\Seeders;

use App\Models\GoldRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoldRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoldRate::create([
            'carat' => '10K',
            'price' => 1217.76
        ]);
        GoldRate::create([
            'carat' => '12K',
            'price' => 1460.14
        ]);

        GoldRate::create([
            'carat' => '14K',
            'price' => 1708.37
        ]);

        GoldRate::create([
            'carat' => '18K',
            'price' => 2190.22
        ]);

        GoldRate::create([
            'carat' => '21K',
            'price' => 2555.25
        ]);

        GoldRate::create([
            'carat' => '22K',
            'price' => 2674.98
        ]);

        GoldRate::create([
            'carat' => '24K',
            'price' => 2917.37
        ]);
        
    }
}
