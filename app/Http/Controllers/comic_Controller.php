<?php

namespace App\Http\Controllers;

use App\Models\comics;
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

        $comic = comics::where('id', $comic_Id)->first();

        $separator = '<i class="bi bi-dot"></i>';

        // Extrae la informacion del comic
        $description = $comic->description;
        $front_Page = $comic->front_Page;
        $extra_Info = '<li>' . $comic->type . '</li>' . $separator . '<li>' . $comic->condition . '</li>';
        $id = $comic->id;
        $name = $comic->name;

        return view('comic', compact('description', 'front_Page', 'extra_Info', 'id', 'name'));
    }


    // Cargar lista de resultados de acuerdo a la busqueda realizada
    public function query($query) {
        $api = 1;
        $type = 'comic';
        
        return view('index', compact('api', 'query', 'type'));
    }
}
