<?php

use App\Http\Controllers\anime_Controller;
use App\Http\Controllers\auth_Controller;
use App\Http\Controllers\comic_Controller;
use App\Http\Controllers\history_Controller;
use App\Http\Controllers\user_Controller;
use Illuminate\Support\Facades\Route;

// Muestra pagina principal (Lista de animes)
Route::get('/', [anime_Controller::class, 'index'])->name('animes');

// Muestra animes cuyo nombre contiene la cadena buscada
Route::get('/animes/search/{query}', [anime_Controller::class, 'query'])->name('anime_Query');

// Muestra informacion sobre el anime seleccionado
Route::get('/animes/{id_Anime}', [anime_Controller::class, 'anime'])->name('anime');



// Muestra pagina principal de comics
Route::get('/comics', [comic_Controller::class, 'index'])->name('comics');

// Muestra comics cuyo nombre contiene la cadena buscada
Route::get('/comics/search/{query}', [comic_Controller::class, 'query'])->name('comic_Query');

// Muestra el comic seleccionado
Route::get('/comics/{id_Comic}', [comic_Controller::class, 'comic'])->name('comic');



// Muestra formulario de inicio de sesión
Route::get('/login', [auth_Controller::class, 'show_Login_Form'])->name('form');

// Envia datos de inicio de sesión
Route::post('/login', [auth_Controller::class, 'login'])->name('login_Submit');



// Cierra sesión
Route::get('/logout', [auth_Controller::class, 'logout'])->name('logout');



// Muestra el formulario de registro
Route::get('/register', [user_Controller::class, 'create'])->name('register');



// Envia datos para la creacion del usuario
Route::post('/user/store', [user_Controller::class, 'store'])->name('user_store');



// Presentar el archivo de video seleccionado
Route::get('/{Id_Anime}/cap-{Chapter}', [anime_Controller::class, 'chapter'])->name('chapter');



// Proteger rutas con middleware de autenticación para evitar que usuario no logeados accedan a ellas
Route::middleware(['auth'])->group(function () {
    // Muestra perfil de usuario logeado
    Route::get('/user/{User}', [user_Controller::class, 'user'])->name('profile');
});