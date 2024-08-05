<?php

namespace App\Http\Controllers;

use App\Libraries\headerManager;
use App\Models\Pet;
use App\Models\Breed;
use App\Models\File;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


class PetController extends Controller
{
    // Mostrar una lista de todas las mascotas
    public function index()
    {
        $headerManager = new headerManager(); // Crea la instancia dentro de la función
        return Inertia::render('Publication/Index', $headerManager->headers('publications'));
    }

    // Mostrar los detalles de una mascota específica
    public function show($slug)
    {
        $pet = Pet::where('slug', $slug)
            ->with('breed', 'province', 'publisher')
            ->firstOrFail();
        return view('pets.show', compact('pet'));
    }

    // Mostrar el formulario para crear una nueva mascota
    public function create()
    {
        $breeds = Breed::all();
        $provinces = Province::all();
        return view('pets.create', compact('breeds', 'provinces'));
    }

    // Guardar una nueva mascota en la base de datos
    public function store(Request $request)
    {
        // Convertir las cadenas "true" y "false" a booleanos
        $data = $request->all();
        $data['vaccinated'] = filter_var($data['vaccinated'], FILTER_VALIDATE_BOOLEAN);
        $data['dewormed'] = filter_var($data['dewormed'], FILTER_VALIDATE_BOOLEAN);
        $data['neutered'] = filter_var($data['neutered'], FILTER_VALIDATE_BOOLEAN);
        $data['special_needs'] = filter_var($data['special_needs'], FILTER_VALIDATE_BOOLEAN);

        $request->merge($data);

        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'breed_id' => 'required|integer|exists:breeds,id',
            'type' => 'required|string|in:Dog,Cat,Other',
            'photo' => 'nullable|image',
            'gender' => 'required|string|in:Male,Female',
            'weight' => 'nullable|numeric',
            'energy_level' => 'required|string|in:Low,Medium,High',
            'age' => 'required|string|in:Baby,Young,Adult,Senior',
            'current_size' => 'required|string|in:Small,Medium,Large,Extra Large',
            'adult_size' => 'required|string|in:Small,Medium,Large,Extra Large',
            'training_level' => 'required|string|in:None,Basic,Intermediate,Advanced',
            'coat' => 'required|string|in:None,Short,Medium,Long,Curly,Hairless',
            'province_id' => 'required|integer|exists:provinces,id',
            'temperament' => 'required|string|in:Passive,Calm,Aggressive,Friendly,Playful,Shy',
            'vaccinated' => 'required|boolean',
            'dewormed' => 'required|boolean',
            'neutered' => 'required|boolean',
            'special_needs' => 'required|boolean',
            'special_needs_notes' => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        $pet = new Pet($request->except('photo'));
        $pet->published_by = Auth::id(); // Asignar el usuario que publica

        // Manejar la carga de la foto
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('photos', 'public');
            $pet->photo = $filePath;
        }

        $pet->save();

        return redirect()->route('pet.view', ['slug' => $pet->slug])
            ->with('success', 'Pet created successfully!');
    }

    // Mostrar el formulario para editar una mascota existente
    public function edit($slug)
    {
        $pet = Pet::where('slug', $slug)->firstOrFail();
        $breeds = Breed::all();
        $provinces = Province::all();
        return view('pets.edit', compact('pet', 'breeds', 'provinces'));
    }

    // Actualizar los detalles de una mascota existente
    public function update(Request $request, $slug)
    {
        // Convertir las cadenas "true" y "false" a booleanos
        $data = $request->all();
        $data['vaccinated'] = filter_var($data['vaccinated'], FILTER_VALIDATE_BOOLEAN);
        $data['dewormed'] = filter_var($data['dewormed'], FILTER_VALIDATE_BOOLEAN);
        $data['neutered'] = filter_var($data['neutered'], FILTER_VALIDATE_BOOLEAN);
        $data['special_needs'] = filter_var($data['special_needs'], FILTER_VALIDATE_BOOLEAN);

        $request->merge($data);

        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'breed_id' => 'required|integer|exists:breeds,id',
            'type' => 'required|string|in:Dog,Cat,Other',
            'photo' => 'nullable|image',
            'gender' => 'required|string|in:Male,Female',
            'weight' => 'nullable|numeric',
            'energy_level' => 'required|string|in:Low,Medium,High',
            'age' => 'required|string|in:Baby,Young,Adult,Senior',
            'current_size' => 'required|string|in:Small,Medium,Large,Extra Large',
            'adult_size' => 'required|string|in:Small,Medium,Large,Extra Large',
            'training_level' => 'required|string|in:None,Basic,Intermediate,Advanced',
            'coat' => 'required|string|in:None,Short,Medium,Long,Curly,Hairless',
            'province_id' => 'required|integer|exists:provinces,id',
            'temperament' => 'required|string|in:Passive,Calm,Aggressive,Friendly,Playful,Shy',
            'vaccinated' => 'required|boolean',
            'dewormed' => 'required|boolean',
            'neutered' => 'required|boolean',
            'special_needs' => 'required|boolean',
            'special_needs_notes' => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        $pet = Pet::where('slug', $slug)->firstOrFail();
        $pet->fill($request->except('photo'));

        // Manejar la carga de la foto
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('photos', 'public');
            $pet->photo = $filePath;
        }

        $pet->save();

        return redirect()->route('pet.view', ['slug' => $pet->slug])
            ->with('success', 'Pet updated successfully!');
    }

    // Eliminar una mascota de la base de datos
    public function destroy($slug)
    {
        $pet = Pet::where('slug', $slug)->firstOrFail();
        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully!');
    }

    public function addFile(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'petId' => 'required|integer|exists:pets,id',
        ]);

        // Manejar la carga del archivo
        $file = $request->file('file');
        $path = $file->store('photos', 'public');

        // Crear el registro en la tabla 'files'
        $newFile = File::create([
            'path' => $path,
            'name' => $file->getClientOriginalName(), // Proporcionar un valor para 'name'
            'size' => $file->getSize(), // Proporcionar un valor para 'size'

        ]);

        // Asociar el archivo con la mascota
        $pet = Pet::find($request->petId);
        $pet->files()->attach($newFile->id);

        // Redirigir a la vista de la mascota
        return redirect()->route('pet.view', ['slug' => $pet->slug])
            ->with('success', 'File added successfully!');
    }

    // Desasociar (eliminar) un archivo de una mascota
    public function removeFile(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'filePath' => 'required|string',
            'petId' => 'required|integer|exists:pets,id',
        ]);

        // Buscar el archivo por la ruta
        $file = File::where('path', $request->filePath)->firstOrFail();
        $pet = Pet::find($request->petId);

        // Verificar si el archivo está asociado con la mascota
        if ($pet->files->contains($file)) {
            $pet->files()->detach($file->id);
            $file->delete();
        }

        return redirect()->route('pet.view', ['slug' => $pet->slug])
            ->with('success', 'File removed successfully!');
    }

    public function activate(Request $request)
    {
        $id = $request->pet_id;
        $pet = Pet::findOrFail($id);
        $pet->active = true;
        $pet->save();

        return redirect()->route('pet.publications')
            ->with('success', 'se ha activado!');
    }

    // Método para desactivar una mascota
    public function deactivate(Request $request)
    {

        $id = $request->pet_id;

        $pet = Pet::findOrFail($id);
        $pet->active = false;
        $pet->save();

        return redirect()->route('pet.publications')
            ->with('success', 'se ha desactivado!');
    }
}
