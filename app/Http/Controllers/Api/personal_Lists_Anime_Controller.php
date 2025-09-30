<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\animes;
use App\Models\personal_Lists_Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class personal_Lists_Anime_Controller extends Controller {
    
    // Obtiene y devuelve elementos de lista indicada
    protected function get_Elements_List($list) {
        $new_List = [];

        foreach($list as $element) {
            $new_List[] = animes::find($element->anime_Id);
        }

        return $new_List;
    }

    // Obtiene y devuelve resultado de consulta basado en si require o no limite de elementos
    protected function get_Query($limit, $list, $user) {
        if ($limit) {
            return personal_Lists_Anime::where('user', $user)->where('list', $list)->limit(4)->get();
        } else {
            return personal_Lists_Anime::where('user', $user)->where('list', $list)->get();
        }
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
    public function list($user, $anime_Id) {
        $list = personal_Lists_Anime::where('user', $user)->where('anime_Id', $anime_Id)->first();

        if ($list) {
            return response()->json($list);
        } else {
            return response()->json(['message' => 'Anime no encontrado en alguna lista']);
        }
    }

    // Devuelve listas para el usuario especificado
    public function lists($user, $limit) {
        $completed = $this->get_Query($limit, 'Completado', $user);
        $discarded = $this->get_Query($limit, 'Descartado', $user);
        $paused = $this->get_Query($limit, 'Pausado', $user);
        $watched = $this->get_Query($limit, 'Por Ver', $user);
        $watching = $this->get_Query($limit, 'Viendo', $user);

        $list_Completed = $this->get_Elements_List($completed);
        $list_Discarded = $this->get_Elements_List($discarded);
        $list_Paused = $this->get_Elements_List($paused);
        $list_Watched = $this->get_Elements_List($watched);
        $list_Watching = $this->get_Elements_List($watching);

        $lists = [
            'Completed' => $list_Completed, 
            'Discarded' => $list_Discarded, 
            'Paused' => $list_Paused, 
            'Watched' => $list_Watched, 
            'Watching' => $list_Watching];

        if (!is_null($lists)) {
            return response()->json($lists);
        } else {
            return response()->json(['message' => 'El usuario no tiene listas']);
        }
    }

    // Elimina anime de lista seleccionada
    public function remove_List(Request $request) {
        DB::table('personal_lists_anime')->where('user', $request->user)->where('anime_Id', $request->anime_Id)->delete();

        return response()->json(['remove' => 'Anime eliminado de lista']);
    }
}
