<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Miky',
            'lastname' => 'de la Cruz',
            'email'  => 'm.delacruz@montedepiedad.gob.do',
            'user' => 'M.delacruz',
            'password' => Hash::make('123456789'),
            'rol_id' => 2,
            'branch_office_id' => 1,

        ]);
    }
}
