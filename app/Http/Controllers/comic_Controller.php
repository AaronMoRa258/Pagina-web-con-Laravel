<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class comic_Controller extends Controller {

    // Cargar lista de comics
    public function index() {
        $api = 0;
        $query = '';
        $type = 'comic';

        return view('index', compact('api', 'query', 'type'));
    }

    // Cargar el comics especificado
    public function comic($comic_Id) {
        // Verifica que el ID sea valido
        if (!is_numeric($comic_Id)) {
            return redirect()->route('comics');
        }

        return view('comic', compact('comic_Id'));
    }


    // Cargar lista de resultados de acuerdo a la busqueda realizada
    public function query($query) {
        $api = 1;
        $type = 'comic';
        
        return view('index', compact('api', 'query', 'type'));
    }
}
