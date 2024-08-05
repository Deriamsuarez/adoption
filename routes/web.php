<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PetController;
use App\Libraries\headerManager;
use App\Models\Favorite;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

$headerManager = new headerManager();

Route::get('/', function () {
    $headerManager = new headerManager();
    return Inertia::render('Welcome/Index', $headerManager->headers('welcome'));
});

Route::get('/donaciones', function () {
    $headerManager = new headerManager();
    return Inertia::render('Donation/Index', $headerManager->headers('common'));
})->name('donation');

Route::prefix('adopcion')->group(function () {
    Route::get('/', function () {
        $headerManager = new HeaderManager(); // Crea la instancia dentro de la función
        return Inertia::render('Adoption/Index', $headerManager->headers('adoption'));
    })->name('adoption');
    Route::get('/{slug}', function ($slug) {
        $headerManager = new HeaderManager(); // Crea la instancia dentro de la función
        return Inertia::render('Adoption/views/Pet', $headerManager->headers('pet', $slug));
    })->name('pet.view');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])
    ->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        Route::post('/form', [FormController::class, 'store'])->name('form.store');

        Route::get('/publicaciones', [PetController::class, 'index'])->name('pet.publications');
        Route::post('/publicaciones', [PetController::class, 'store'])->name('pet.store');

        Route::post('/pet/files', [PetController::class, 'addFile'])->name('pet.files.add');
        Route::delete('/pets/files', [PetController::class, 'removeFile'])->name('pet.files.remove');
        Route::patch('/pets/activate', [PetController::class, 'activate'])->name('pet.activate');
        Route::patch('/pets/deactivate', [PetController::class, 'deactivate'])->name('pet.deactivate');
        Route::get('/favoritos', [FavoriteController::class, 'index'])->name('favorites');
        Route::post('/favorite/{id}', [FavoriteController::class, 'store'])->name('create.favorite');
        Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy'])->name('delete.favorite');
    });
