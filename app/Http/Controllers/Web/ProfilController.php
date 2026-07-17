<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ProfilController extends Controller
{
    //
    public function edit(){
        return view('profile.edit');
    }
    public function update(Request $request)
    {
        $valide = $request->validate([
            'current_password' => ['required','current_password'],
            'password' => ['required', 'string', 'min:8','confirmed'],
        ]);
        $user = $request->user();
        $user->update([
        'password' => $valide['password'],
        ]);
        return back()->with('success', 'Mot de passe modifié avec succès.');
    }
}
