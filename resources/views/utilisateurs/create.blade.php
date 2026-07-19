@extends('layouts.app')

@section('titre', 'Ajouter un nouvel utilisateur ')

@section('contenu')
    <div class="breadcrumb"><a href="{{ route('utilisateurs.index') }}">← Utilisateurs</a></div>

    <div class="card" style="max-width:460px;">
       <h1>Ajouter un utilisateur</h1>
       <form method="POST" action="{{ route('utilisateurs.store') }}">
            @csrf
            <div class="form-group">
                <label for="nom">Nom complet</label>
                <input type="text" id="nom" name="nom" value=" {{old('nom')}} " required autofocus>
                @error('nom') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label for="role">Rôle</label>
                <select id="role" name="role" required>
                    <option value="employe" {{ old('role') == 'employe' ? 'selected' : '' }}>Employé</option>
                    <option value="gestionnaire" {{ old('role') == 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role') <div class="field-error">{{ $message }}</div> @enderror
            </div>
             <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>

    </div>
@endsection
