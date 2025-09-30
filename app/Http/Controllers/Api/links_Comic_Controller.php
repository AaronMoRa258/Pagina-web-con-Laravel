<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\links_Comic;
use Illuminate\Http\Request;

class links_Comic_Controller extends Controller {
    
    // Devuelve enlace al capitulo del comic seleccionado
    public function comic($comic_Id) {
        $links = links_Comic::where('comic_Id', $comic_Id)->get();

        if ($links) {
            return response()->json($links);
        } else {
            return response()->json(['error' => 'Enlaces no encontrado'], 404);
        }
    }

    // Devuelve lista de animes en grupos de 15 para resultados de busqueda
    public function search($query, Request $request) {
        $page = $request->query('P', 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;
        
        $comics = comics::where('name', 'like', "%{$query}%")->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
        
        if ($comics->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados']);
        }

        return response()->json($comics);
    }
}
