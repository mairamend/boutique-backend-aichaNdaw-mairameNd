@extends('layouts.app')

@section('titre', 'Nouvel acheteur')

@section('contenu')
    <div class="breadcrumb"><a href="{{ route('acheteurs.index') }}">← Acheteurs</a></div>

    <div class="card" style="max-width:520px;">
        <form action="{{ route('acheteurs.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required autofocus>
                @error('nom') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}">
                @error('telephone') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('acheteurs.index') }}" class="btn btn-outline">Annuler</a>
            </div>
        </form>
    </div>
@endsection
