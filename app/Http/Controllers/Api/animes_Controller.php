<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\animes;
use Illuminate\Http\Request;

class animes_Controller extends Controller {
    
    // Devuelve lista de animes en grupos de 15 para pagina principal
    public function index(Request $request) {
        $page = $request->query('P', 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $animes = animes::orderBy('id', 'desc')->offset($offset)->limit($limit)->get();

        return response()->json($animes);
    }

    // Devuelve informacion relacionada al anime seleccionado
    public function information($anime_Id_Information) {
        $anime = animes::find($anime_Id_Information);

        if ($anime) {
            return response()->json($anime);
        } else {
            return response()->json(['error' => 'Anime no encontrado'], 404);
        }
    }

    // Devuelve lista de animes en grupos de 15 para resultados de busqueda
    public function search($query, Request $request) {
        $page = $request->query('P', 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;
        
        $animes = animes::where('name', 'like', "%{$query}%")->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
        
        if ($animes->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados']);
        }

        return response()->json($animes);
    }
}
