<?php

namespace App\Http\Controllers;

use App\Models\animes;
use Illuminate\Http\Request;

class anime_Controller extends Controller {
    
    // Cargar lista de animes
    public function index() {
        $api = 0;
        $query = '';
        $type = 'anime';

        return view('index', compact('api', 'query', 'type'));
    }

    // Cargar informacion relativa al anime especificado
    public function anime($anime_Id) {   
        // Verifica que el ID sea valido
        if (!is_numeric($anime_Id)) {
            return redirect()->route('animes');
        }

        // Realiza consulta a BD
        $anime = animes::where('id', $anime_Id)->first();

        $separator = '<i class="bi bi-dot"></i>';
        
        // Extrae la informacion del anime
        $chapters = $anime->chapters;
        $description = $anime->description;
        $extra_Info = $anime->type . $separator . $anime->year . $separator . $anime->season . $separator . $anime->condition;
        $id = $anime->id;
        $image = $anime->image;
        $name = $anime->name;
        
        return view('anime', compact('chapters', 'description', 'extra_Info', 'id', 'image', 'name'));
    }

    // Cargar capitulo
    public function chapter($anime_Id, $chapter_Id) {
        return view('chapters', compact('anime_Id', 'chapter_Id'));
    }

    // Cargar lista de resultados de acuerdo a la busqueda realizada
    public function query($query) {
        $api = 1;
        $type = 'anime';
        
        return view('index', compact('api', 'query', 'type'));
    }
}
