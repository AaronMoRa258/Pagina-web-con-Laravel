<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class AnimeChapterController extends Controller {

    // Cargar capitulo
    public function show($animeId, $chapterId) {
        // Verifica que el ID del anime sea valido
        if (!is_numeric($animeId)) {
            return redirect()->route("animes.index");
        }

        // Verifica que el ID del capitulo sea valido
        if (!is_numeric($chapterId)) {
            $chapterId = 1;
            return redirect()->route("chapters.show", [
                    "animeId" => $animeId,  
                    "chapterId" => $chapterId     
            ]);
        }

        // Realiza consulta a BD
        $anime = Anime::where("id", $animeId)->first();

        $separator = "<i class='bi bi-dot'></i>";
        
        // Extrae la informacion del anime
        $chaptersNumber = $anime->chapters_number;
        $description = $anime->description;
        $extraInfo = "<li>" . $anime->type . "</li>" . $separator . "<li>" . $anime->year . "</li>" . $separator . "<li>" . $anime->season . "</li>" . $separator . "<li>" . $anime->condition . "</li>";
        $id = $anime->id;
        $name = $anime->name;
        
        return view("chapters", compact("chapterId", "description", "extraInfo", "id", "name", "chaptersNumber"));
    }
}
