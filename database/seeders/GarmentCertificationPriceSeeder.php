<?php

namespace Database\Seeders;

use App\Models\GarmentCertificationPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GarmentCertificationPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GarmentCertificationPrice::create([
            'description' => 'Precio de certificación',
            'price' => 500,
        ]);
    }
}
