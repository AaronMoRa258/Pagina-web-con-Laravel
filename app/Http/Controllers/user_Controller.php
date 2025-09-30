<?php
namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class user_Controller extends Controller {
    
    // Muestra formulario de registro
    public function create() {
        return view('register');
    }

    // Procesa el nuevo usuario
    public function store(Request $Request) {
        $Request->validate([
            'User' => 'required|string|max:255',
            'Nombre' => 'required|string|max:255',
            'Email' => 'required|string|email|unique:users',
            'Password' => 'required|string|min:6',
        ]);

        User::create([
            'User' => $Request->User,
            'Nombre' => $Request->Name,
            'Email' => $Request->Email,
            'Password' => Hash::make($Request->Password),
        ]);

        return redirect('/');
    }

    // Muestra perfil de usuario
    public function user(Request $Request) {
        $Info_User = User::where('User', $Request->User)->first();
        $Followers = Followers::where('follow', $Request->User)->count();
        $Following = Followers::where('user', $Request->User)->count();

        if (!$Info_User) {
            if (Auth::user()->User == '') {
                return redirect('/');
            }

            return redirect()->route('profile',  ['User' => Auth::user()->User]);
        }

        $User = $Info_User->User;
        $Name = $Info_User->Nombre;
        return view('user', compact('Followers', 'Following','Name', 'User'));
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
