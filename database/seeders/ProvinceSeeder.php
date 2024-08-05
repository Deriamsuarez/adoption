<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            'Distrito Nacional',
            'Santo Domingo',
            'Azua',
            'Bahoruco',
            'Barahona',
            'Dajabón',
            'Duarte',
            'Elías Piña',
            'El Seibo',
            'Espaillat',
            'Hato Mayor',
            'La Altagracia',
            'La Romana',
            'La Vega',
            'María Trinidad Sánchez',
            'Monseñor Nouel',
            'Monte Cristi',
            'Monte Plata',
            'Pedernales',
            'Peravia',
            'Puerto Plata',
            'Samaná',
            'San Cristóbal',
            'San José de Ocoa',
            'San Juan',
            'San Pedro de Macorís',
            'Sánchez Ramírez',
            'Santiago',
            'Santiago Rodríguez',
            'Valverde',
        ];

        foreach ($provinces as $province) {
            Province::create([
                'name' => $province,
                'slug' => Str::slug($province) // Generar un slug a partir del nombre
            ]);
        }
    }
}
