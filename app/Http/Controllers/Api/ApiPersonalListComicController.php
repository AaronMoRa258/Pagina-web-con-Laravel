<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\PersonalListComic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPersonalListComicController extends Controller {
    
    // Obtiene y devuelve elementos de lista indicada
    protected function getElementsList($list, $user) {
        $query_Results = PersonalListComic::where("user", $user)->where("list", $list)->limit(5)->get();
        $new_List = [];

        foreach($query_Results as $element) {
            $new_List[] = Comic::find($element->comic_id);
        }

        return $new_List;
    }

    // Elimina anime de lista seleccionada
    public function destroy(Request $request) {
        DB::table("personal_lists_comic")->where("user", $request->user)->where("comic_id", $request->elementId)->delete();

        return response()->json(["remove" => "Comic eliminado de lista"]);
    }

    // Devuelve listas para el usuario especificado
    public function index($user) {
        $lists = [
            "Completed" => $this->getElementsList("Completado", $user), 
            "Discarded" => $this->getElementsList("Descartado", $user), 
            "Paused" => $this->getElementsList("Pausado", $user), 
            "Watched" => $this->getElementsList("Por Ver", $user), 
            "Watching" => $this->getElementsList("Viendo", $user)];

        if (!is_null($lists)) {
            return response()->json($lists);
        }
            
        return response()->json(["message" => "El usuario no tiene listas"]);
    }

    // Comprueba si un anime esta en alguna lista para el usuario especificado
    public function show($user, $comicId) {
        $list = PersonalListComic::where("user", $user)->where("comic_id", $comicId)->first();

        if ($list) {
            return response()->json($list);
        }
            
        return response()->json(["message" => "Comic no encontrado en alguna lista"]);
    }

    // Agrega anime a lista seleccionada
    public function store(Request $request) {
        PersonalListComic::create([
            "user" => $request->user,
            "comic_id" => $request->elementId,
            "list" => $request->list
        ]);

        return response()->json(["added" => "Comic agregado a lista"]);
    }
}
