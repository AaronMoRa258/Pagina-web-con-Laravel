<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\animes;
use App\Models\bookmarks_Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bookmarks_Anime_Controller extends Controller {
    
    // Agrega anime a favoritos
    public function add_Bookmark(Request $request) {
        bookmarks_Anime::create([
            'user' => $request->user,
            'anime_Id' => $request->anime_Id
        ]);

        return response()->json(['added' => 'Anime agregado a favoritos']);
    }

    // Comprueba si un anime esta en lista de marcadores del usuario especificado
    public function bookmark($user, $anime_Id) {
        $bookmark = bookmarks_Anime::where('user', $user)->where('anime_Id', $anime_Id)->first();

        if ($bookmark) {
            return response()->json($bookmark);
        } else {
            return response()->json(['message' => 'Anime no encontrado en favoritos']);
        }
    }

    // Devuelve favoritos del usuario
    public function bookmarks($user, $limit) {
        $bookmark_List = [];

        if ($limit) {
            $bookmarks = bookmarks_Anime::where('user', $user)->limit(4)->get();
        } else {
            $bookmarks = bookmarks_Anime::where('user', $user)->get();
        }

        foreach ($bookmarks as $bookmark) {
            $bookmark_List[] = animes::find($bookmark->anime_Id);
        }

        if (!is_null($bookmark_List)) {
            return response()->json($bookmark_List);
        } else {
            return response()->json(['message' => 'No hay animes en favoritos']);
        }
    }

    // Elimina anime de favoritos
    public function remove_Bookmark(Request $request) {
        DB::table('bookmarks_anime')->where('user', $request->user)->where('anime_Id', $request->anime_Id)->delete();

        return response()->json(['removed' => 'Anime eliminado de favoritos']);
    }
}
