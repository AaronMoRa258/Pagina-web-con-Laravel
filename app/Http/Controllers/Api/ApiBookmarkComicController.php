<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookmarkComic;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiBookmarkComicController extends Controller {
    
    // Elimina anime de favoritos
    public function destroy(Request $request) {
        DB::table("bookmarks_comic")->where("user", $request->user)->where("comic_id", $request->elementId)->delete();

        return response()->json(["removed" => "Comic eliminado de favoritos"]);
    }
    
    // Devuelve favoritos del usuario
    public function index($user, $limit) {
        $bookmarkList = [];

        if ($limit) {
            $bookmarks = BookmarkComic::where("user", $user)->limit(4)->get();
        } else {
            $bookmarks = BookmarkComic::where("user", $user)->get();
        }

        foreach ($bookmarks as $bookmark) {
            $bookmarkList[] = Comic::find($bookmark->comic_id);
        }

        if (!is_null($bookmarkList)) {
            return response()->json($bookmarkList);
        } 
        
        return response()->json(["message" => "No hay comics en favoritos"]);
    }

    // Comprueba si un anime esta en lista de marcadores del usuario especificado
    public function show($user, $comicId) {
        $bookmark = BookmarkComic::where("user", $user)->where("comic_id", $comicId)->first();

        if ($bookmark) {
            return response()->json($bookmark);
        }
            
        return response()->json(["message" => "Comic no encontrado en favoritos"]);
    }

    // Agrega anime a favoritos
    public function store(Request $request) {
        BookmarkComic::create([
            "user" => $request->user,
            "comic_id" => $request->elementId
        ]);

        return response()->json(["added" => "Comic agregado a favoritos"]);
    }
}
