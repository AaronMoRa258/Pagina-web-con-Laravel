<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ComicController extends Controller {

    // Cargar lista de comics
    public function index() {
        return Inertia::render("Index", [
            "api" => 0,
            "login" => Auth::check(),
            "query" => "",
            "type" => "comic",
        ]);
    }

    // Cargar lista de resultados de acuerdo a la busqueda realizada
    public function query($query) {
        return Inertia::render("Index", [
            "api" => 1,
            "login" => Auth::check(),
            "query" => $query,
            "type" => "comic",
        ]);
    }

    // Cargar el comics especificado
    public function show($comicId) {
        // Verifica que el ID sea valido
        if (!is_numeric($comicId)) {
            return redirect()->route("comics.index");
        }

        $comic = Comic::where("id", $comicId)->first();

        $separator = "<i class='bi bi-dot'></i>";

        // Extrae la informacion del comic
        $description = $comic->description;
        $frontPage = $comic->front_page;
        $extraInfo = "<li>" . $comic->type . "</li>" . $separator . "<li>" . $comic->condition . "</li>";
        $id = $comic->id;
        $name = $comic->name;

        return Inertia::render("Comic", [
            "description" => $description,
            "extraInfo" => $extraInfo,
            "frontPage" => $frontPage,
            "id" => $id,
            "login" => Auth::check(),
            "name" => $name,            
        ]);
    }
}
