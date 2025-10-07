<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LinkAnime;
use Illuminate\Http\Request;

class ApiLinkAnimeController extends Controller {
    
    // Devuelve enlace al capitulo del anime seleccionado
    public function show($animeId, $chapterId) {
        $link = LinkAnime::where("anime_id", $animeId)->where("chapter_id", $chapterId)->first();

        if ($link) {
            return response()->json($link);
        }
            
        return response()->json(["error" => "Enlace no encontrado"], 404);
    }
}
