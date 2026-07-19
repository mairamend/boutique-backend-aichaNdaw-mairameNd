@extends('layouts.app')
@section('titre','Acheteurs')
@section('topbar-actions')
    @can('create',\App\Models\Acheteur::class)
        <a href="{{ route('acheteurs.create') }}" class="btn btn-primary">+ Nouvel acheteur</a>
    @endcan
@endsection
@section('contenu')
<div class="card">
        @if($acheteurs->count())
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th style="width:1%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($acheteurs as $acheteur)
                        <tr>
                            <td><strong>{{ $acheteur->nom }}</strong></td>
                            <td>{{ $acheteur->email }}</td>
                            <td>{{ $acheteur->telephone ?: '—' }}</td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('acheteurs.show', $acheteur) }}" class="btn btn-outline btn-sm">Voir</a>
                                    @can('update',$acheteur)
                                        <a href="{{ route('acheteurs.edit', $acheteur) }}" class="btn btn-outline btn-sm">Modifier</a>
                                    @endcan 
                                    @can('delete',$acheteur)   
                                        <form action="{{ route('acheteurs.destroy', $acheteur) }}" method="POST"
                                              onsubmit="return confirm('Supprimer cet acheteur ?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger-outline btn-sm">Supprimer</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">Aucun acheteur pour le moment.</div>
        @endif
    </div>

   
@endsection
       