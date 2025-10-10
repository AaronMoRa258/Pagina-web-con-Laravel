<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AnimeController extends Controller {
    
    // Cargar lista de animes
    public function index() {
        $user = (Auth::check()) ? Auth::user()->user : "";

        return Inertia::render("Index", [
            "api" => 0,
            "query" => "",
            "type" => "anime",
            "userName" => $user,
        ]);
    }

    // Cargar lista de resultados de acuerdo a la busqueda realizada
    public function query($query) {
        $user = (Auth::check()) ? Auth::user()->user: "";

        return Inertia::render("Index", [
            "api" => 1,
            "query" => $query,
            "type" => "anime",
            "userName" => $user,
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
        $user = (Auth::check()) ? Auth::user()->user: "";
        
        return Inertia::render("Anime", [
            "chaptersNumber" => $chaptersNumber,
            "description" => $description,
            "extraInfo" => $extraInfo,
            "id" => $id,
            "image" => $image,
            "name" => $name,
            "userName" => $user,
        ]);
    }
}
