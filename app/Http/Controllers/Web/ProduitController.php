<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produits = Produit::all();
        return view('produits.index',compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Categorie::all();
        $this->authorize('create',Produit::class);
        return view('produits.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create',Produit::class);
        $valid = $request->validate([
            'nom' => ['required','string','max:255'],
            'categorie_id' => ['required','exists:categories,id'],
            'prix' =>['numeric','required','min:0'],
            'stock' => ['integer'],
            'description' => ['nullable','string'],
        ]);
        Produit::create($valid);
        return redirect()->route('produits.index')->with('success','Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        //
        return view('produits.show',compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        //
        $this->authorize('update',$produit);
        $categories = Categorie::all();
        return view('produits.edit',compact('produit','categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        //
        $this->authorize('update',$produit);
        $valid = $request->validate([
            'nom' => ['required','string','max:255'],
            'categorie_id' => ['required','exists:categories,id'],
            'prix' =>['numeric','required','min:0'],
            'stock' => ['integer'],
            'description' => ['nullable','string'],
        ]);
        $produit->update($valid);
        return redirect()->route('produits.index')->with('success','Produit modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        //
        $this->authorize('delete',$produit);
        try{
            $produit->delete();
        }catch(\Illuminate\Database\QueryException $e){
            return back()->with('error', 'Impossible de supprimer: ce produit est liée à des achats.');
        }
            
        return redirect()->route('produits.index')->with('success','produit supprimé avec succès.');
    }
}
