<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\BookmarkAnime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiBookmarkAnimeController extends Controller {

    // Elimina anime de favoritos
    public function destroy(Request $request) {
        DB::table("bookmarks_anime")->where("user", $request->user)->where("anime_id", $request->elementId)->delete();

        return response()->json(["removed" => "Anime eliminado de favoritos"]);
    }

    // Devuelve favoritos del usuario
    public function index($user, $limit) {
        $bookmarkList = [];

        if ($limit) {
            $bookmarks = BookmarkAnime::where("user", $user)->limit(4)->get();
        } else {
            $bookmarks = BookmarkAnime::where("user", $user)->get();
        }

        foreach ($bookmarks as $bookmark) {
            $bookmarkList[] = Anime::find($bookmark->anime_id);
        }

        if (!is_null($bookmarkList)) {
            return response()->json($bookmarkList);
        } 
        
        return response()->json(["message" => "No hay animes en favoritos"]);
    }

    // Comprueba si un anime esta en lista de marcadores del usuario especificado
    public function show($user, $animeId) {
        $bookmark = BookmarkAnime::where("user", $user)->where("anime_id", $animeId)->first();

        if ($bookmark) {
            return response()->json($bookmark);
        }
            
        return response()->json(["message" => "Anime no encontrado en favoritos"]);
    }

    // Agrega anime a favoritos
    public function store(Request $request) {
        BookmarkAnime::create([
            "user" => $request->user,
            "anime_id" => $request->elementId
        ]);

        return response()->json(["added" => "Anime agregado a favoritos"]);
    }
}
