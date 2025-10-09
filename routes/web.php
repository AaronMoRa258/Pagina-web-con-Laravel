<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AnimeChapterController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", [AnimeController::class, "index"])->name("animes.index");
Route::get("/animes/search/{query}", [AnimeController::class, "query"])->name("animes.query");
Route::get("/animes/{animeId}", [AnimeController::class, "show"])->name("animes.show");
Route::get("/animes/{animeId}/cap-{chapterId}", [AnimeChapterController::class, "show"])->name("chapters.show");

Route::get("/comics", [ComicController::class, "index"])->name("comcis.index");
Route::get("/comics/search/{query}", [ComicController::class, "query"])->name("comics.query");
Route::get("/comics/{comicId}", [ComicController::class, "show"])->name("comcis.show");



Route::get("/dashboard", function () {
    return Inertia::render("Dashboard");
})->middleware(["auth", "verified"])->name("dashboard");

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");
});

require __DIR__."/auth.php";
