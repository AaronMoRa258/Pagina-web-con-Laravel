<?php

namespace App\Http\Controllers;

use \App\Models\user;
use \App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class auth_Controller extends Controller {
    
    // Procesar login
    public function login(Request $Request) {
        $Credentials = [
            'User' => $Request->User,
            'password' => $Request->Password,
        ];

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

        return redirect('/');
    }

    // Mostrar formulario de login
    public function show_Login_Form() {
        return view('login');
    }
}
