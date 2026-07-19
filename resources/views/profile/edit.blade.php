@extends('layouts.app')

@section('titre', 'Mon profil')

@section('contenu')
    <div class="card" style="max-width:460px;">
        <h2 style="margin-top:0;">{{ auth()->user()->nom }}</h2>
        <p style="color:var(--gris-texte); font-size:0.9rem;">{{ auth()->user()->email }} — {{ auth()->user()->role }}</p>

        <form action="{{ route('profil.update') }}" method="POST" style="margin-top:1.5rem;">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password">Mot de passe actuel</label>
                <input type="password" id="current_password" name="current_password" required>
                @error('current_password') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" required>
                @error('password') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
            </div>
        </form>
    </div>
@endsection