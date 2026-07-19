@extends('layouts.app')
@section('titre','Produits')
@section('topbar-actions')
    
        @can('create', \App\Models\Produit::class)
            <a href="{{ route('produits.create') }}" class="btn btn-primary">+ Nouveau produit</a>
        @endcan
   
@endsection
@section('contenu')
<div class="card">
    @if($produits->count())
    <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th style="width:1%;"></th>
                    </tr>
                </thead>
                <tbody>



    @foreach($produits as $produit)
    <tr>
                            <td><strong>{{ $produit->nom }}</strong></td>
                            <td>{{ $produit->categorie->nom ?? '—' }}</td>
                            <td>{{ number_format($produit->prix, 2) }} FCFA</td>
                            <td>{{ $produit->stock }}</td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('produits.show', $produit) }}" class="btn btn-outline btn-sm">Voir</a>
                                  
                                        @can('update', $produit)
                                            <a href="{{ route('produits.edit', $produit) }}" class="btn btn-outline btn-sm">Modifier</a>
                                        @endcan 
                                        @can('delete', $produit)   
                                            <form action="{{ route('produits.destroy', $produit) }}" method="POST"
                                                    onsubmit="return confirm('Supprimer ce produit ?');">
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
            <div class="empty-state">Aucun produit pour le moment.</div>
        @endif
    </div>     



@endsection