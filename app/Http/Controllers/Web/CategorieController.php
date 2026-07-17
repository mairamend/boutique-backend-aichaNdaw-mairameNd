<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Auth\Middleware\Authorize;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Categorie::all();
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create', Categorie::class);
        return view('categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create',Categorie::class);
        $valid = $request->validate([
            'nom' => ['required','string','max:255','unique:categories,nom'],
            'description' => ['nullable','string'],
        ]);
        Categorie::create($valid);
        return redirect()->route('categories.index')->with('success', 'Categorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
        return view('categories.show',compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
        $this->authorize('update', $categorie);
        return view('categories.edit',compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        //
        $this->authorize('update', $categorie);
        $valid = $request->validate([
            'nom' => ['required','string','max:255','unique:categories,nom,'.$categorie->id],
            'description' => ['nullable','string'],
        ]);
        $categorie->update($valid);
        return redirect()->route('categories.index')->with('success', 'Categorie modifié  avec succès.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        //
        $this->authorize('delete',$categorie);
        try{
            $categorie->delete();
        }catch(\Illuminate\Database\QueryException $e){
            return back()->with('error', 'Impossible de supprimer : cette categorie a des produits qui sont liés à lui');
        }
        return redirect()->route('categories.index')->with('success','Categorie supprimée avec succés.');
    }
}
