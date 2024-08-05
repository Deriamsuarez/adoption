<?php
namespace App\Http\Controllers;

use App\Libraries\headerManager;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FavoriteController extends Controller
{

    public function index()
    {
        $headerManager = new headerManager(); // Crea la instancia dentro de la función
        return Inertia::render('Favorites/Index', $headerManager->headers('favorites'));
    }

    public function store($id)
    {
        // Obtener la ID del usuario autenticado
        $userId = Auth::id();

        // Crear el favorito
        $favorite = Favorite::create([
            'user_id' => $userId,
            'pet_id' => $id
        ]);

        // Retornar una respuesta indicando que el favorito fue creado
        return redirect()->route('adoption')
        ->with('success', 'se ha activado!');
    }

    /**
     * Elimina un favorito específico de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar el favorito por ID
        $favorite = Favorite::find($id);

        if ($favorite) {
            // Eliminar el favorito
            $favorite->delete();

            // Retornar una respuesta indicando que el favorito fue eliminado
            return redirect()->route('adoption')
            ->with('success', 'se ha eliminado correctamente!');
        } 
    }
}
