<?php
namespace App\Http\Controllers;

use App\Models\followers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class user_Controller extends Controller {
    
    // Mostrar formulario de registro
    public function create() {
        return view('register');
    }

    // Procesar el nuevo usuario
    public function store(Request $request) {
        $request->validate([
            'User' => 'required|string|max:255',
            'Nombre' => 'required|string|max:255',
            'Email' => 'required|string|email|unique:users',
            'Password' => 'required|string|min:6',
        ]);

        // Inserta nuevo registro a tabla de usuarios
        user::create([
            'User' => $request->User,
            'Nombre' => $request->Name,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
        ]);

        return redirect('/');
    }

    // Mostrar perfil de usuario especificado
    public function user(Request $request) {
        // Realiza consulta a BD
        $info_User = user::where('User', $request->User)->first();
        $followers = followers::where('follow', $request->User)->count();
        $following = followers::where('user', $request->User)->count();

        // Verifica que el usuario exista
        if (!$info_User) {
            // Verifica que el usuario este autenticado (haya iniciado sesion)
            if (Auth::user()->User == '') {
                return redirect('/');
            }

            return redirect()->route('profile',  ['User' => Auth::user()->User]);
        }

        // Extrae la informacion del usuario
        $user = $info_User->User;
        $name = $info_User->Nombre;
        
        return view('user', compact('followers', 'following','name', 'user'));
    }





    

    public function show(User $User) {
        return view('index', compact('User'));
    }

    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index');
    }
}
