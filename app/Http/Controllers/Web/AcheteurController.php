<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Acheteur;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AcheteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $acheteurs = Acheteur::all();
        return view('acheteurs.index',compact('acheteurs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create',Acheteur::class);
        return view('acheteurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create',Acheteur::class);
        $valid = $request->validate([
            'nom' => ['required','string','max:255'],
            'email' => ['required','string','max:255','unique:acheteurs,email'],
            'telephone' => ['nullable','string','max:255']
        ]);
        Acheteur::create($valid);
        return redirect()->route('acheteurs.index')->with('success', 'Acheteur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Acheteur $acheteur)
    {
        //
        $produits = Produit::all();
        return view('acheteurs.show',compact('acheteur','produits'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acheteur $acheteur)
    {
        //
        $this->authorize('update',$acheteur);
          
        return view('acheteurs.edit',compact('acheteur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Acheteur $acheteur)
    {
        //
        $this->authorize('update',$acheteur);
        $valid = $request->validate([
            'nom' => ['required','string','max:255'],
            'email' => ['required','string','max:255','unique:acheteurs,email,'.$acheteur->id],
            'telephone' => ['nullable','string','max:255']
        ]);
        $acheteur->update($valid);
        return redirect()->route('acheteurs.index')->with('success','Acheteur modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acheteur $acheteur)
    {
        //
        $this->authorize('delete',$acheteur);
       
            $acheteur->delete();
        
            return redirect()->route('acheteurs.index')->with('success', 'Acheteur supprimé avec succès.');
    }
    public function acheter(Request $request, Acheteur $acheteur){
        // Validation des données 
        $donnees = $request->validate([
        'produit_id' => ['required', 'exists:produits,id'],
        'quantite' => ['required', 'integer', 'min:1'],
        'date_achat' => ['required', 'date', 'before_or_equal:today'],
    ]);
    try{
        DB::transaction(function() use ($donnees,$acheteur){
            // Verrouiller et récuperer le produit
            $produit = Produit::where('id',$donnees['produit_id'])->lockForUpdate()->firstOrFail();
            // Verifier le stock apres verrou
            if($produit->stock < $donnees['quantite']){
                throw new \RuntimeException("Stock insuffisant pour \"{$produit->nom}\" (disponible : {$produit->stock}).");

            }
            // 4. Créer l'achat
            $acheteur->achats()->create([
                'produit_id' => $produit->id,
                'quantite' => $donnees['quantite'],
                'date_achat' => $donnees['date_achat'],
            ]);
            // 5. Décrémenter le stock
            $produit->decrement('stock', $donnees['quantite']);
        });
    }catch(\RuntimeException $e){
         return back()->withErrors(['quantite' => $e->getMessage()])->withInput();
    }
     return redirect()->route('acheteurs.show', $acheteur)->with('success', 'Achat enregistré, stock mis à jour.');
    }
}
