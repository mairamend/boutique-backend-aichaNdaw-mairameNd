@extends('layouts.app')
@section('titre','Modifier' . $categorie->nom)
@section('contenu')
<div class="breadcrumb"><a href="{{ route('categories.index') }}">← Catégories</a></div>

    <div class="card" style="max-width:520px;">
        <form action="{{ route('categories.update', $categorie) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $categorie->nom) }}" required autofocus>
                @error('nom') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description', $categorie->description) }}</textarea>
                @error('description') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline">Annuler</a>
            </div>
        </form>
    </div>
@endsection
