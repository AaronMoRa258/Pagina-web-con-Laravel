<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller {
    
    public function histories() {
        $Content = "";
        return view("histories", compact("Content"));
    }

    public function save(Request $Request) {
        $Content = $Request->input("Content");

        // Nombre del archivo (lo puedes cambiar o generar dinámicamente)
        $Name_File = "mi_texto.txt";

        // Guardar en storage/app
        Storage::disk("public")->put($Name_File, $Content);

        return view("histories", compact("Content"));
    }

    public function show() {
        // Leer el contenido del archivo
        $Content = Storage::get("mi_texto.txt");

        return view("histories", compact("Content"));
    }
}
