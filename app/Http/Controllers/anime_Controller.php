<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class anime_Controller extends Controller {
    
    // Cargar anime
    public function index() {
        $api = 0;
        $query = '';
        $type = 'anime';
        return view('index', compact('api', 'query', 'type'));
    }

    // Cargar anime
    public function anime($anime_Id) {
        return view('anime', compact('anime_Id'));
    }

    // Cargar capitulo
    public function chapter($anime_Id, $chapter_Id) {
        return view('chapters', compact('anime_Id', 'chapter_Id'));
    }

    // Cargar resultados de busqueda
    public function query($query) {
        $api = 1;
        $type = 'anime';
        return view('index', compact('api', 'query', 'type'));
    }
}
