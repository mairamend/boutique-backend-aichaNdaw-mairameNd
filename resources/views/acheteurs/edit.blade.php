@extends('layouts.app')

@section('titre', 'Modifier ' . $acheteur->nom)

@section('contenu')
    <div class="breadcrumb"><a href="{{ route('acheteurs.index') }}">← Acheteurs</a></div>

    <div class="card" style="max-width:520px;">
        <form action="{{ route('acheteurs.update', $acheteur) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $acheteur->nom) }}" required autofocus>
                @error('nom') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $acheteur->email) }}" required>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" value="{{ old('telephone', $acheteur->telephone) }}">
                @error('telephone') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('acheteurs.index') }}" class="btn btn-outline">Annuler</a>
            </div>
        </form>
    </div>
@endsection
