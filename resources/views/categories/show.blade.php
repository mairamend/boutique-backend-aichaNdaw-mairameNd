@extends('layouts.app')

@section('titre',$categorie->nom)
@section('topbar-actions')
    @can('update',$categorie)
        <a href="{{ route('categories.edit',$categorie) }}" class="btn btn-primary">Modifier</a>
    @endcan
@endsection

@section('contenu')
    <div class="breadcrumb"><a href="{{ route('categories.index') }}">← Catégories</a></div>
    <div class="card">
        <h2 style="margin-top:0;">{{ $categorie->nom }}</h2>
        <p style="color:var(--text-muted);">{{ $categorie->description ?: 'Aucune description.' }}</p>

    </div>
    <div class="card">
        <div class="card-header">
            <h2>Produits de cette catégorie</h2>
        </div>
        @if($categorie->produits->count())
            <table>
                <thead>
                    <tr><th>Nom</th><th>Prix</th><th>Stock</th><th style="width:1%;"></th></tr>
                </thead>
                <tbody>
                    @foreach($categorie->produits as $produit)
                        <tr>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ number_format($produit->prix, 2) }} €</td>
                            <td>{{ $produit->stock }}</td>
                            <td><a href="{{ route('produits.show', $produit) }}" class="btn btn-outline btn-sm">Voir</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="empty-state">Aucun produit dans cette catégorie.</div>
            @endif
    </div>
@endsection    