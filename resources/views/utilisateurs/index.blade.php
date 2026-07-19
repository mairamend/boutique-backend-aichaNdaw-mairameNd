@extends('layouts.app')

@section('titre', 'Utilisateurs & rôles')
@section('topbar-actions')
    <a href="{{ route('utilisateurs.create') }}" class="btn btn-primary">+ Nouvel utilisateur</a>
@endsection
@section('contenu')
<div class="card">
        @if($utilisateurs->count())
            <table>
                <thead>
                    <tr><th>Nom</th><th>Email</th><th>Rôle</th><th style="width:1%;"></th></tr>
                </thead>
                <tbody>
                    @foreach($utilisateurs as $user)
                    @if($user->id !== auth()->id())
                        <tr>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge badge-{{ $user->role }}">{{ $user->role }}</span>
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('utilisateurs.edit', $user) }}" class="btn btn-outline btn-sm">Modifier le rôle</a>
                                    @can('delete', $user)
                                        <form action="{{ route('utilisateurs.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger-outline btn-sm">Supprimer</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endif    
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">Aucun utilisateur.</div>
        @endif
    </div>

   
@endsection
