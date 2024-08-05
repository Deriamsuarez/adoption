<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Breed;

class BreedSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $breeds = [
            ['name' => 'Labrador Retriever', 'type' => 'Dog'],
            ['name' => 'German Shepherd', 'type' => 'Dog'],
            ['name' => 'Bulldog', 'type' => 'Dog'],
            ['name' => 'Beagle', 'type' => 'Dog'],
            ['name' => 'Poodle', 'type' => 'Dog'],
            ['name' => 'Siamese', 'type' => 'Cat'],
            ['name' => 'Persian', 'type' => 'Cat'],
            ['name' => 'Maine Coon', 'type' => 'Cat'],
            ['name' => 'Bengal', 'type' => 'Cat'],
            ['name' => 'Sphynx', 'type' => 'Cat'],
            ['name' => 'Rabbit', 'type' => 'Other'],
            ['name' => 'Hamster', 'type' => 'Other'],
            ['name' => 'Guinea Pig', 'type' => 'Other'],
            ['name' => 'Ferret', 'type' => 'Other'],
        ];

        foreach ($breeds as $breed) {
            Breed::create([
                'name' => $breed['name'],
                'slug' => Str::slug($breed['name']),
                'type' => $breed['type'],
            ]);
        }
    }
}
