<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\links_Anime;
use Illuminate\Http\Request;

class links_Anime_Controller extends Controller {
    
    // Devuelve enlace al capitulo del anime seleccionado
    public function chapter($anime_Id, $chapter_Id) {
        $link = links_Anime::where('anime_Id', $anime_Id)->where('chapter_Id', $chapter_Id)->first();

        if ($link) {
            return response()->json($link);
        } else {
            return response()->json(['error' => 'Enlace no encontrado'], 404);
        }
    }
}
