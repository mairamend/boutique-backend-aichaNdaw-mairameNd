@extends('layouts.app')

@section('titre', 'Modifier ' . $produit->nom)

@section('contenu')
    <div class="breadcrumb"><a href="{{ route('produits.index') }}">← Produits</a></div>

    <div class="card" style="max-width:560px;">
        <form action="{{ route('produits.update', $produit) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" required autofocus>
                @error('nom') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="categorie_id">Catégorie</label>
                <select id="categorie_id" name="categorie_id" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}"
                            {{ old('categorie_id', $produit->categorie_id) == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                @error('categorie_id') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div style="display:flex; gap:14px;">
                <div class="form-group" style="flex:1;">
                    <label for="prix">Prix (€)</label>
                    <input type="number" step="0.01" min="0" id="prix" name="prix" value="{{ old('prix', $produit->prix) }}" required>
                    @error('prix') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group" style="flex:1;">
                    <label for="stock">Stock</label>
                    <input type="number" min="0" id="stock" name="stock" value="{{ old('stock', $produit->stock) }}" required>
                    @error('stock') <div class="field-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description', $produit->description) }}</textarea>
                @error('description') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('produits.index') }}" class="btn btn-outline">Annuler</a>
            </div>
        </form>
    </div>
@endsection
