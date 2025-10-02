<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\comics;
use App\Models\bookmarks_Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bookmarks_Comic_Controller extends Controller {
    
    // Agrega anime a favoritos
    public function add_Bookmark(Request $request) {
        bookmarks_Comic::create([
            'user' => $request->user,
            'comic_Id' => $request->element_Id
        ]);

        return response()->json(['added' => 'Comic agregado a favoritos']);
    }

    // Comprueba si un anime esta en lista de marcadores del usuario especificado
    public function bookmark_Check($user, $comic_Id) {
        $bookmark = bookmarks_Comic::where('user', $user)->where('comic_Id', $comic_Id)->first();

        if ($bookmark) {
            return response()->json($bookmark);
        }
            
        return response()->json(['message' => 'Comic no encontrado en favoritos']);
    }

    // Devuelve favoritos del usuario
    public function bookmarks_Get($user, $limit) {
        $bookmark_List = [];

        if ($limit) {
            $bookmarks = bookmarks_Comic::where('user', $user)->limit(4)->get();
        } else {
            $bookmarks = bookmarks_Comic::where('user', $user)->get();
        }

        foreach ($bookmarks as $bookmark) {
            $bookmark_List[] = comics::find($bookmark->comic_Id);
        }

        if (!is_null($bookmark_List)) {
            return response()->json($bookmark_List);
        } 
        
        return response()->json(['message' => 'No hay comics en favoritos']);
    }

    // Elimina anime de favoritos
    public function remove_Bookmark(Request $request) {
        DB::table('bookmarks_anime')->where('user', $request->user)->where('comic_Id', $request->element_Id)->delete();

        return response()->json(['removed' => 'Comic eliminado de favoritos']);
    }
}
