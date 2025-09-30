<?php
namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::with('user')->get();
        return view('sessions.index', compact('sessions'));
    }

    public function destroy($id)
    {
        Session::destroy($id); // Cierra la sesión
        return redirect()->route('sessions.index');
    }
}
