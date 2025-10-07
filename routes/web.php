<?php

use App\Http\Controllers\AnimeChapterController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Muestra pagina principal (Lista de animes)
Route::get("/", [AnimeController::class, "index"])->name("animes.index");

// Muestra animes cuyo nombre contiene la cadena buscada
Route::get("/animes/search/{query}", [AnimeController::class, "query"])->name("animes.search");

// Muestra informacion sobre el anime seleccionado
Route::get("/animes/{id_Anime}", [AnimeController::class, "show"])->name("animes.show");



// Muestra pagina principal de comics
Route::get("/comics", [ComicController::class, "index"])->name("comics.index");

// Muestra comics cuyo nombre contiene la cadena buscada
Route::get("/comics/search/{query}", [ComicController::class, "query"])->name("comics.search");

// Muestra el comic seleccionado
Route::get("/comics/{id_Comic}", [ComicController::class, "show"])->name("comics.show");



// Muestra formulario de inicio de sesión
Route::get("/login", [AuthController::class, "show_Login_Form"])->name("form");

// Envia datos de inicio de sesión
Route::post("/login", [AuthController::class, "login"])->name("login_Submit");



// Cierra sesión
Route::get("/logout", [AuthController::class, "logout"])->name("logout");



// Muestra el formulario de registro
Route::get("/register", [UserController::class, "create"])->name("register");



// Envia datos para la creacion del usuario
Route::post("/user/store", [UserController::class, "store"])->name("user_store");



// Presentar el archivo de video seleccionado
Route::get("/{Id_Anime}/cap-{Chapter}", [AnimeChapterController::class, "show"])->name("chapters.show");



// Proteger rutas con middleware de autenticación para evitar que usuario no logeados accedan a ellas
Route::middleware(["auth"])->group(function () {
    // Muestra perfil de usuario logeado
    Route::get("/user/{User}", [UserController::class, "user"])->name("profile");
});