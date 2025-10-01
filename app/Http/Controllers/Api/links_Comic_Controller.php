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
        }
            
        return response()->json(['error' => 'Enlaces no encontrado'], 404);
    }
}
