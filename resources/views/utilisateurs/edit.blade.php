@extends('layouts.app')

@section('titre', 'Modifier le rôle de ' . $utilisateur->nom)

@section('contenu')
    <div class="breadcrumb"><a href="{{ route('utilisateurs.index') }}">← Utilisateurs</a></div>

    <div class="card" style="max-width:460px;">
        <p style="color:var(--text-muted); font-size:13px;">
            <strong>{{ $utilisateur->nom }}</strong> — {{ $utilisateur->email }}
        </p>
        <form action="{{ route('utilisateurs.update', $utilisateur) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="role">Rôle</label>
                <select id="role" name="role" {{ $utilisateur->id === auth()->id() ? 'disabled' : '' }} required>
                    <option value="employe" {{ $utilisateur->role === 'employe' ? 'selected' : '' }}>Employé</option>
                    <option value="gestionnaire" {{ $utilisateur->role === 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                    <option value="admin" {{ $utilisateur->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Mettre à jour le rôle</button>
                <a href="{{ route('utilisateurs.index') }}" class="btn btn-outline">Annuler</a>
            </div>
        </form>
    </div>
@endsection
