<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\animes;
use App\Models\personal_Lists_Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class personal_Lists_Anime_Controller extends Controller {
    
    // Obtiene y devuelve elementos de lista indicada
    protected function get_Elements_List($list, $user) {
        $query_Results = personal_Lists_Anime::where('user', $user)->where('list', $list)->limit(4)->get();
        $new_List = [];

        foreach($query_Results as $element) {
            $new_List[] = animes::find($element->anime_Id);
        }

        return $new_List;
    }

    // Agrega anime a lista seleccionada
    public function add_List(Request $request) {
        personal_Lists_Anime::create([
            'user' => $request->user,
            'anime_Id' => $request->anime_Id,
            'list' => $request->list
        ]);

        return response()->json(['added' => 'Anime agregado a lista']);
    }

    // Comprueba si un anime esta en alguna lista para el usuario especificado
    public function list_Check($user, $anime_Id) {
        $list = personal_Lists_Anime::where('user', $user)->where('anime_Id', $anime_Id)->first();

        if ($list) {
            return response()->json($list);
        }
            
        return response()->json(['message' => 'Anime no encontrado en alguna lista']);
    }

    // Devuelve listas para el usuario especificado
    public function lists_Get($user) {
        $lists = [
            'Completed' => $this->get_Elements_List('Completado', $user), 
            'Discarded' => $this->get_Elements_List('Descartado', $user), 
            'Paused' => $this->get_Elements_List('Pausado', $user), 
            'Watched' => $this->get_Elements_List('Por Ver', $user), 
            'Watching' => $this->get_Elements_List('Viendo', $user)];

        if (!is_null($lists)) {
            return response()->json($lists);
        }
            
        return response()->json(['message' => 'El usuario no tiene listas']);
    }

    // Elimina anime de lista seleccionada
    public function remove_List(Request $request) {
        DB::table('personal_lists_anime')->where('user', $request->user)->where('anime_Id', $request->anime_Id)->delete();

        return response()->json(['remove' => 'Anime eliminado de lista']);
    }
}
