<?php

use App\Http\Controllers\Api\ApiAnimeController;
use App\Http\Controllers\Api\ApiBookmarkAnimeController;
use App\Http\Controllers\Api\ApiBookmarkComicController;
use App\Http\Controllers\Api\ApiComicController;
use App\Http\Controllers\Api\ApiLinkAnimeController;
use App\Http\Controllers\Api\ApiLinkComicController;
use App\Http\Controllers\Api\ApiPersonalListAnimeController;
use App\Http\Controllers\Api\ApiPersonalListComicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Carga animes para la pagina principal
Route::get("/animes", [ApiAnimeController::class, "index"]);

// Agrega anime a marcadores del usuario
Route::post("/animes/bookmarks/store", [ApiBookmarkAnimeController::class, "store"]);

// Elimina anime de marcadores del usuario
Route::post("/animes/bookmarks/destroy", [ApiBookmarkAnimeController::class, "destroy"]);

// Comprueba si un anime esta en lista de marcadores del usuario 
Route::get("/animes/bookmarks/check/{user}/{anime_Id}", [ApiBookmarkAnimeController::class, "show"]);

// Carga marcadores del usuario
Route::get("/animes/bookmarks/load/{user}/{limit}", [ApiBookmarkAnimeController::class, "index"]);

// Agrega anime a lista indicada del usuario
Route::post("/animes/lists/store", [ApiPersonalListAnimeController::class, "store"]);

// Agrega anime a lista indicada del usuario
Route::post("/animes/lists/destroy", [ApiPersonalListAnimeController::class, "destroy"]);

// Carga listas del usuario
Route::get("/animes/lists/load/{user}", [ApiPersonalListAnimeController::class, "index"]);

// Comprueba si un anime esta en lista de marcadores del usuario
Route::get("/animes/lists/check/{user}/{anime_Id}", [ApiPersonalListAnimeController::class, "show"]);

// Carga animes para resultados de busqueda
Route::get("/animes/search/{query}", [ApiAnimeController::class, "search"]);

// Carga capitulo del anime seleccionado
Route::get("/animes/{anime_Id}/{chapter_Id}", [ApiLinkAnimeController::class, "show"]);



// Carga comics para la pagina principal
Route::get("/comics", [ApiComicController::class, "index"]);

// Carga comic seleccionado
Route::get("/comics/{comic_Id}", [ApiLinkComicController::class, "show"]);

// Agrega anime a marcadores del usuario
Route::post("/comics/bookmarks/store", [ApiBookmarkComicController::class, "store"]);

// Elimina anime de marcadores del usuario
Route::post("/comics/bookmarks/destroy", [ApiBookmarkComicController::class, "destroy"]);

// Comprueba si un anime esta en lista de marcadores del usuario 
Route::get("/comics/bookmarks/check/{user}/{comic_Id}", [ApiBookmarkComicController::class, "show"]);

// Carga marcadores del usuario
Route::get("/comics/bookmarks/load/{user}/{limit}", [ApiBookmarkComicController::class, "index"]);

// Agrega anime a lista indicada del usuario
Route::post("/comics/lists/store", [ApiPersonalListComicController::class, "store"]);

// Agrega anime a lista indicada del usuario
Route::post("/comics/lists/destroy", [ApiPersonalListComicController::class, "destroy"]);

// Carga listas del usuario
Route::get("/comics/lists/load/{user}", [ApiPersonalListComicController::class, "index"]);

// Comprueba si un anime esta en lista de marcadores del usuario
Route::get("/comics/lists/check/{user}/{comic_Id}", [ApiPersonalListComicController::class, "show"]);

// Carga comics para resultados de busqueda
Route::get("/comics/search/{query}", [ApiComicController::class, "search"]);


Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");
