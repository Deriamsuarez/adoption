<?php
namespace App\Libraries;

use App\Models\Breed;
use Illuminate\Foundation\Application;
use App\Models\Pet;
use App\Models\Favorite;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class headerManager
{
    function headers($page, $slug = null): array
    {
        $user = Auth::user();
        $userId = Auth::id();

        if (Auth::check()) {
            $userData = [
                'name' => $user->name,
                'email' => $user->email,
                'profile_photo_path' => $user->profile_photo_path,
            ];
        } else {
            $userData = null;
        };

        $commonHeader = [
            'canLogin' => !Auth::check(),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'user' => $userData,
        ];

        switch ($page) {
            case 'common':
                return array_merge($commonHeader, []);

            case 'welcome':
                return array_merge($commonHeader, [
                    'photos' => Pet::get('photo'),
                ]);

            case 'pet':
                $pet = Pet::where('slug', $slug)->first();
                $canEdit = Auth::check() && Auth::id() === $pet->published_by;

                return array_merge($commonHeader, [
                    'pet' => function () use ($slug) {
                        $pet = Pet::with(['breed', 'province', 'files'])->where('slug', $slug)->first();
                        if (!$pet) {
                            return null;
                        }

                        $paths = [];
                        if (isset($pet->photo)) {
                            $paths[] = $pet->photo;
                        }
                        foreach ($pet->files as $file) {
                            if (isset($file->path)) {
                                $paths[] = $file->path;
                            }
                        }

                        $isFavorite = false;
                        if (Auth::check()) {
                            $userId = Auth::id();
                            $favorite = Favorite::where('user_id', $userId)
                                ->where('pet_id', $pet->id)
                                ->first();
                            $isFavorite = $favorite !== null;
                        }

                        $relatedPets = Pet::with(['breed', 'province'])
                            ->where('type', $pet->type)
                            ->where('slug', '!=', $slug)
                            ->take(4)
                            ->get();

                        return array_merge($pet->toArray(), [
                            'all_photos' => $paths,
                            'related_pets' => $relatedPets,
                            'is_favorite' => $isFavorite
                        ]);
                    },
                    'canEdit' => $canEdit
                ]);

            case 'adoption':
                $pets = Pet::with(['breed', 'province', 'favorites'])
                    ->where('active', true)
                    ->get()
                    ->map(function ($pet) use ($userId) {
                        $pet->is_favorite = false;
                        if (Auth::check()) {
                            $favorite = Favorite::where('user_id', $userId)
                                ->where('pet_id', $pet->id)
                                ->first();
                            $pet->is_favorite = $favorite !== null;
                        }
                        return $pet;
                    });

                return array_merge($commonHeader, [
                    'pets' => $pets,
                    'filters' => [
                        'breeds' => Breed::all(),
                        'provinces' => Province::all(),
                        'types' => ['Dog', 'Cat', 'Other'],
                        'genders' => ['Male', 'Female'],
                        'energy_levels' => ['Low', 'Medium', 'High'],
                        'ages' => ['Baby', 'Young', 'Adult', 'Senior'],
                        'current_sizes' => ['Small', 'Medium', 'Large'],
                        'adult_sizes' => ['Small', 'Medium', 'Large'],
                        'training_levels' => ['Basic', 'Intermediate', 'Advanced'],
                        'coats' => ['Short', 'Medium', 'Long', 'Curly', 'Hairless'],
                        'temperaments' => ['Passive', 'Calm', 'Aggressive', 'Friendly', 'Playful', 'Shy']
                    ]
                ]);

            case 'publications':
                return array_merge($commonHeader, [
                    'pets' => Pet::with(['breed', 'province'])
                        ->where('published_by', $userId)
                        ->get(),
                    'provinces' => Province::all(),
                    'breeds' => Breed::all()
                ]);

                case 'favorites':
                    return array_merge($commonHeader, [
                        'favorites' => Favorite::with('pet.breed')
                            ->where('user_id', $userId)
                            ->get()
                            ->unique('pet_id') // Elimina duplicados basados en 'pet_id'
                            ->values() // Reinicia los índices de la colección
                    ]);
                
        }

        return $commonHeader;
    }
}
