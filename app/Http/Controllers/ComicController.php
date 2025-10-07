<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;

class ComicController extends Controller {

    // Cargar lista de comics
    public function index() {
        $api = 0;
        $query = "";
        $type = "comic";

        return view("index", compact("api", "query", "type"));
    }

    // Cargar lista de resultados de acuerdo a la busqueda realizada
    public function query($query) {
        $api = 1;
        $type = "comic";
        
        return view("index", compact("api", "query", "type"));
    }

    // Cargar el comics especificado
    public function show($comicId) {
        // Verifica que el ID sea valido
        if (!is_numeric($comicId)) {
            return redirect()->route("comics");
        }

        $comic = Comic::where("id", $comicId)->first();

        $separator = "<i class='bi bi-dot'></i>";

        // Extrae la informacion del comic
        $description = $comic->description;
        $frontPage = $comic->front_page;
        $extraInfo = "<li>" . $comic->type . "</li>" . $separator . "<li>" . $comic->condition . "</li>";
        $id = $comic->id;
        $name = $comic->name;

        return view("comic", compact("description", "extraInfo", "frontPage", "id", "name"));
    }
}
