<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use Illuminate\Http\Request;

class ApiComicController extends Controller {

    // Devuelve lista de comics en grupos de 15 para pagina principal
    public function index(Request $request) {
        $page = $request->query("P", 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $comics = Comic::orderBy("id", "desc")->offset($offset)->limit($limit)->get();

        return response()->json($comics);
    }

    // Devuelve lista de animes en grupos de 15 para resultados de busqueda
    public function search($query, Request $request) {
        $page = $request->query("P", 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;
        
        $comics = Comic::where("name", "like", "%{$query}%")->orderBy("id", "desc")->offset($offset)->limit($limit)->get();
        
        if ($comics->isEmpty()) {
            return response()->json(["message" => "No se encontraron resultados"]);
        }

        return response()->json($comics);
    }
}
