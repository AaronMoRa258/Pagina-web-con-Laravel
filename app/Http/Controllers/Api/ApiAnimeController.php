<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;

class ApiAnimeController extends Controller {
    
    // Devuelve lista de animes en grupos de 15 para pagina principal
    public function index(Request $request) {
        $page = $request->query("P", 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;

        $animes = Anime::orderBy("id", "desc")->offset($offset)->limit($limit)->get();

        if ($animes->isEmpty()) {
            return response()->json(["message" => "No se encontraron resultados"]);
        }
        
        return response()->json($animes);
    }

    // Devuelve lista de animes en grupos de 15 para resultados de busqueda
    public function search($query, Request $request) {
        $page = $request->query("P", 1);
        $limit = 15;
        $offset = ($page - 1) * $limit;
        
        $animes = Anime::where("name", "like", "%{$query}%")->orderBy("id", "desc")->offset($offset)->limit($limit)->get();
        
        if ($animes->isEmpty()) {
            return response()->json(["message" => "No se encontraron resultados"]);
        }

        return response()->json($animes);
    }
}
