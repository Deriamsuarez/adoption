<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Deriam Suarez',
            'email' => 'deriamsuarez50@gmail.com',
            'password' => Hash::make('Password.1'),
            'id_card' => '1234567890', // Asegúrate de proporcionar un valor único si hay restricción
            'age' => 30, // Puedes ajustar esto si es necesario
            'mobile' => '123-456-7890', // Puedes ajustar esto si es necesario
            'phone' => '098-765-4321', // Puedes ajustar esto si es necesario
            'address' => '123 Main St', // Puedes ajustar esto si es necesario
            'province_id' => 1, // Asegúrate de que el ID de la provincia sea válido
        ]);
    }
}
