<?php

namespace App\Http\Controllers;

use \App\Models\User;
use \App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller {
    
    // Procesar login
    public function login(Request $Request) {
        // Recupera credenciales ingresadas
        $Credentials = [
            'User' => $Request->User,
            'password' => $Request->Password,
        ];

        // Verificar credenciales
        if (Auth::attempt($Credentials)) {
            // Login exitoso
            $Request->session()->regenerate(); // Protege contra session fixation
            return redirect('/');
        }

        // Login fallido
        return back()->withErrors([
            'User' => 'Las credenciales no son correctas',
        ], 404);
    }

    // Cerrar sesión
    public function logout(Request $Request) {
        Auth::logout();
        $Request->session()->invalidate();
        $Request->session()->regenerateToken();
    }

    // Mostrar formulario de login
    public function loginFormShow() {
        return Inertia::render("Auth/Login");
    }
}
