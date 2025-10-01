<?php

use App\Http\Controllers\Api\animes_Controller;
use App\Http\Controllers\Api\bookmarks_Anime_Controller;
use App\Http\Controllers\Api\bookmarks_Comic_Controller;
use App\Http\Controllers\Api\comics_Controller;
use App\Http\Controllers\Api\links_Anime_Controller;
use App\Http\Controllers\Api\links_Comic_Controller;
use App\Http\Controllers\Api\personal_Lists_Anime_Controller;
use App\Http\Controllers\Api\personal_Lists_Comic_Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Carga animes para la pagina principal
Route::get('/animes', [animes_Controller::class, 'index']);

// Agrega anime a marcadores del usuario
Route::post('/animes/bookmarks/add', [bookmarks_Anime_Controller::class, 'add_Bookmark']);

// Elimina anime de marcadores del usuario
Route::post('/animes/bookmarks/remove', [bookmarks_Anime_Controller::class, 'remove_Bookmark']);

// Comprueba si un anime esta en lista de marcadores del usuario 
Route::get('/animes/bookmarks/check/{user}/{anime_Id}', [bookmarks_Anime_Controller::class, 'bookmark_Check']);

// Carga marcadores del usuario
Route::get('/animes/bookmarks/load/{user}/{limit}', [bookmarks_Anime_Controller::class, 'bookmarks_Get']);

// Agrega anime a lista indicada del usuario
Route::post('/animes/lists/add', [personal_Lists_Anime_Controller::class, 'add_List']);

// Agrega anime a lista indicada del usuario
Route::post('/animes/lists/remove', [personal_Lists_Anime_Controller::class, 'remove_List']);

// Carga listas del usuario
Route::get('/animes/lists/load/{user}', [personal_Lists_Anime_Controller::class, 'lists_Get']);

// Comprueba si un anime esta en lista de marcadores del usuario
Route::get('/animes/lists/check/{user}/{anime_Id}', [personal_Lists_Anime_Controller::class, 'list_Check']);

// Carga animes para resultados de busqueda
Route::get('/animes/search/{query}', [animes_Controller::class, 'search']);

// Carga informacion relacionada al anime seleccionado
Route::get('/animes/{anime_Id_Information}', [animes_Controller::class, 'information']);

// Carga capitulo del anime seleccionado
Route::get('/animes/{anime_Id}/{chapter_Id}', [links_Anime_Controller::class, 'chapter']);



// Carga comics para la pagina principal
Route::get('/comics', [comics_Controller::class, 'index']);

// Carga comic seleccionado
Route::get('/comics/{comic_Id}', [links_Comic_Controller::class, 'comic']);

// Agrega anime a marcadores del usuario
Route::post('/comics/bookmarks/add', [bookmarks_Comic_Controller::class, 'add_Bookmark']);

// Elimina anime de marcadores del usuario
Route::post('/comics/bookmarks/remove', [bookmarks_Comic_Controller::class, 'remove_Bookmark']);

// Comprueba si un anime esta en lista de marcadores del usuario 
Route::get('/comics/bookmarks/check/{user}/{comic_Id}', [bookmarks_Comic_Controller::class, 'bookmark']);

// Carga marcadores del usuario
Route::get('/comics/bookmarks/load/{user}/{limit}', [bookmarks_Comic_Controller::class, 'bookmarks']);

// Agrega anime a lista indicada del usuario
Route::post('/comics/lists/add', [personal_Lists_Comic_Controller::class, 'add_List']);

// Agrega anime a lista indicada del usuario
Route::post('/comics/lists/remove', [personal_Lists_Comic_Controller::class, 'remove_List']);

// Comprueba si un anime esta en lista de marcadores del usuario
Route::get('/comics/lists/check/{user}/{comic_Id}', [personal_Lists_Comic_Controller::class, 'list']);

// Carga listas del usuario
Route::get('/comics/lists/load/{user}/{limit}', [personal_Lists_Comic_Controller::class, 'lists']);

// Carga comics para resultados de busqueda
Route::get('/comics/search/{query}', [comics_Controller::class, 'search']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
