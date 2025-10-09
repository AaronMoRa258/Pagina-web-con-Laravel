<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AnimeController extends Controller {
    
    // Cargar lista de animes
    public function index() {
        return Inertia::render("Index", [
            "api" => 0,
            "login" => Auth::check(),
            "query" => "",
            "type" => "anime",
        ]);
    }

    // Cargar lista de resultados de acuerdo a la busqueda realizada
    public function query($query) {
        return Inertia::render("Index", [
            "api" => 1,
            "login" => Auth::check(),
            "query" => $query,
            "type" => "anime",
        ]);
    }

    // Cargar informacion relativa al anime especificado
    public function show($animeId) {   
        // Verifica que el ID del anime sea valido
        if (!is_numeric($animeId)) {
            return redirect()->route("animes.index");
        }

        // Realiza consulta a BD
        $anime = Anime::where("id", $animeId)->first();

        $separator = "<i class='bi bi-dot'></i>";
        
        // Extrae la informacion del anime
        $chaptersNumber = $anime->chapters_number;
        $description = $anime->description;
        $extraInfo = "<li>" . $anime->type . "</li>" . $separator . "<li>" . $anime->year . "</li>" . $separator . "<li>" . $anime->season . "</li>" . $separator . "<li>" . $anime->condition . "</li>";
        $id = $anime->id;
        $image = $anime->image;
        $name = $anime->name;
        
        return Inertia::render("Anime", [
            "chaptersNumber" => $chaptersNumber,
            "description" => $description,
            "extraInfo" => $extraInfo,
            "id" => $id,
            "image" => $image,
            "login" => Auth::check(),
            "name" => $name,
        ]);
    }
}
