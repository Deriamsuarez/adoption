<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Pet;
use App\Models\Breed; // Asegúrate de importar los modelos necesarios
use App\Models\Province;
use App\Models\User;

class PetSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Obtén algunas razas, provincias y usuarios para asociar con las mascotas
        $breeds = Breed::all();
        $provinces = Province::all();
        $users = User::all();

        // Verifica que hay datos para razas, provincias y usuarios
        if ($breeds->isEmpty() || $provinces->isEmpty() || $users->isEmpty()) {
            $this->command->error('No hay razas, provincias o usuarios para asociar.');
            return;
        }

        $pets = [
            [
                'name' => 'Rex',
                'slug' => Str::slug('Rex'),
                'description' => 'Un perro amistoso y juguetón.',
                'breed_id' => $breeds->where('name', 'Labrador Retriever')->first()->id,
                'type' => 'Dog',
                'photo' => 'images/pet1.jpg',
                'gender' => 'Male',
                'weight' => 25.5,
                'energy_level' => 'High',
                'age' => 'Young',
                'current_size' => 'Medium',
                'adult_size' => 'Large',
                'training_level' => 'Basic',
                'coat' => 'Short',
                'province_id' => $provinces->where('name', 'Distrito Nacional')->first()->id,
                'temperament' => 'Friendly',
                'vaccinated' => true,
                'dewormed' => true,
                'neutered' => false,
                'special_needs' => false,
                'special_needs_notes' => '',
                'medical_history' => 'Historial médico completo.',
                'published_by' => $users->random()->id, // Asocia con un usuario aleatorio
            ],
            [
                'name' => 'Whiskers',
                'slug' => Str::slug('Whiskers'),
                'description' => 'Un gato curioso y juguetón.',
                'breed_id' => $breeds->where('name', 'Siamese')->first()->id,
                'type' => 'Cat',
                'photo' => 'images/pet2.jpg',
                'gender' => 'Female',
                'weight' => 4.5,
                'energy_level' => 'Medium',
                'age' => 'Adult',
                'current_size' => 'Small',
                'adult_size' => 'Small',
                'training_level' => 'None',
                'coat' => 'Short',
                'province_id' => $provinces->where('name', 'Santiago')->first()->id,
                'temperament' => 'Playful',
                'vaccinated' => true,
                'dewormed' => false,
                'neutered' => true,
                'special_needs' => false,
                'special_needs_notes' => '',
                'medical_history' => 'Requiere control regular.',
                'published_by' => $users->random()->id, // Asocia con un usuario aleatorio
            ],
            // Agrega más mascotas según sea necesario
        ];

        foreach ($pets as $pet) {
            Pet::create([
                'name' => $pet['name'],
                'slug' => $pet['slug'],
                'description' => $pet['description'],
                'breed_id' => $pet['breed_id'],
                'type' => $pet['type'],
                'photo' => $pet['photo'],
                'gender' => $pet['gender'],
                'weight' => $pet['weight'],
                'energy_level' => $pet['energy_level'],
                'age' => $pet['age'],
                'current_size' => $pet['current_size'],
                'adult_size' => $pet['adult_size'],
                'training_level' => $pet['training_level'],
                'coat' => $pet['coat'],
                'province_id' => $pet['province_id'],
                'temperament' => $pet['temperament'],
                'vaccinated' => $pet['vaccinated'],
                'dewormed' => $pet['dewormed'],
                'neutered' => $pet['neutered'],
                'special_needs' => $pet['special_needs'],
                'special_needs_notes' => $pet['special_needs_notes'],
                'medical_history' => $pet['medical_history'],
                'published_by' => $pet['published_by'],
            ]);
        }
    }
}
