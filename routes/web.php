<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AnimeChapterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", [AnimeController::class, "index"])->name("animes.index");
Route::get("/animes/search/{query}", [AnimeController::class, "query"])->name("animes.query");
Route::get("/animes/{animeId}", [AnimeController::class, "show"])->name("animes.show");
Route::get("/animes/{animeId}/cap-{chapterId}", [AnimeChapterController::class, "show"])->name("chapters.show");

Route::get("/comics", [ComicController::class, "index"])->name("comcis.index");
Route::get("/comics/search/{query}", [ComicController::class, "query"])->name("comics.query");
Route::get("/comics/{comicId}", [ComicController::class, "show"])->name("comcis.show");



Route::get('/email/verify', function () {
    return inertia('Auth/VerifyEmail'); // 👈 componente Vue
})->middleware('auth')->name('verification.notice');

// enlace que llega al correo
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard'); // 👈 o la ruta que desees
})->middleware(['auth', 'signed'])->name('verification.verify');

// reenviar el correo
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Se ha enviado un nuevo enlace de verificación.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::post("/logout", [AuthController::class, "logout"])->name("logout");

Route::get("/dashboard", function () {
    return Inertia::render("Dashboard");
})->middleware(["auth", "verified"])->name("dashboard");

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");
});

require __DIR__."/auth.php";
