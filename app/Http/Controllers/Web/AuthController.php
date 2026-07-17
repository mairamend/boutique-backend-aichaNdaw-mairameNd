<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showLogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        $identifiants = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);
         if (! Auth::attempt($identifiants)) {
        return back()->withErrors(['email' => 'Identifiants incorrects.'])->onlyInput('email');
    }

    $request->session()->regenerate();

    return redirect()->intended('/');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }
    public function showRegister()
    {
        return view('auth.register');
    }
}
