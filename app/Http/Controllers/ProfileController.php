<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(Request $request) {
        // Realiza consulta a BD
        $userInfo = User::where('user', $request->idUser)->first();
        $followers = Follower::where('follow', $request->idUser)->count();
        $following = Follower::where('user', $request->idUser)->count();

        // Verifica que el usuario exista
        if (!$userInfo) {
            // Verifica que el usuario este autenticado (haya iniciado sesion)
            if (Auth::user()->user == '') {
                return redirect()->route('animes.index');
            }

            return redirect()->route('profile.show',  ['idUser' => Auth::user()->user]);
        }

        // Extrae la informacion del usuario
        $user = $userInfo->user;
        $name = $userInfo->name;

        return Inertia::render("Profile/Show", [
            "followers" => $followers,
            "following" => $following,
            "name" => $name,
            "user" => $user,
        ]);
    }
}
