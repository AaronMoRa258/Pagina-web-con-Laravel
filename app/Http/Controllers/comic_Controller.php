<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class comic_Controller extends Controller {

    // Carga pagina principal de comics
    public function index() {
        $api = 0;
        $query = '';
        $type = 'comic';
        return view('index', compact('api', 'query', 'type'));
    }

    // Cargar comic
    public function comic($comic_Id) {
        return view('comic', compact('comic_Id'));
    }


    // Cargar resultados de busqueda
    public function query($query) {
        $api = 1;
        $type = 'comic';
        return view('index', compact('api', 'query', 'type'));
    }
}
