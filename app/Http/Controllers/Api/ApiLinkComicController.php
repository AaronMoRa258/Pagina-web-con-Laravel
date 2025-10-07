<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LinkComic;
use Illuminate\Http\Request;

class ApiLinkComicController extends Controller {
    
    // Devuelve enlace al capitulo del comic seleccionado
    public function show($comicId) {
        $link = LinkComic::where("comic_id", $comicId)->get();

        if ($link) {
            return response()->json($link);
        }
            
        return response()->json(["error" => "Enlaces no encontrado"], 404);
    }
}
