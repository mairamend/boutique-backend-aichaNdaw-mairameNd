<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;


class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $utilisateurs =  Utilisateur::all();
        return view('utilisateurs.index',compact('utilisateurs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create',Utilisateur::class);
        return view('utilisateurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create',Utilisateur::class);
        $valide = $request->validate([
            'nom' => ['string','required','max:255'],
            'email' => ['required','email','unique:utilisateurs,email'],
           
            'role' => ['required','in:employe,gestionnaire,admin'],
        ]);
        $valide['password'] = 'password123';
        Utilisateur::create($valide);
        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur créé avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Utilisateur $utilisateur)
    {
        //
        return view('utilisateurs.show',compact('utilisateur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utilisateur $utilisateur)
    {
        //
         $this->authorize('update', $utilisateur);
         return view('utilisateurs.edit',compact('utilisateur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        //
        $this->authorize('update', $utilisateur);
         $valide = $request->validate([
            'role' => ['required','in:employe,gestionnaire,admin'],
        ]);
        $utilisateur->update($valide);
        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        //
        $this->authorize('delete', $utilisateur);
        $utilisateur->delete();
        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
        
    }
}
