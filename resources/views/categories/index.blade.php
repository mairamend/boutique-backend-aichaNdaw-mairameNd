@extends('layouts.app')
@section('titre','Categories')

@section('topbar-actions')
    @can('create',\App\Models\Categorie::class)
        <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Nouvelle catégorie</a>
    @endcan
@endsection

@section('contenu')
    <div class="card">
       @if($categories->count()) 
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Produits</th>
                    <th style="width:1%;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $categorie)
                <tr>
                    <td><strong>{{ $categorie->nom }}</strong></td>
                            <td style="color:var(--text-muted);">{{ Str::limit($categorie->description, 60) ?: '—' }}</td>
                            <td>{{ $categorie->produits_count ?? $categorie->produits->count() }}</td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('categories.show', $categorie) }}" class="btn btn-outline btn-sm">Voir</a>
                                    @can('update',$categorie)
                                        <a href="{{ route('categories.edit',$categorie) }}" class="btn btn-outline btn-sm">Modifier</a>
                                    @endcan
                                    @can('delete',$categorie)
                                        <form action="{{ route('categories.destroy',$categorie) }}" method="POST"
                                              onsubmit="return confirm('Supprimer cette catégorie ?');">
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
            <div class="empty-state">Aucune catégorie pour le moment.</div>
        @endif    
    </div>
@endsection    
