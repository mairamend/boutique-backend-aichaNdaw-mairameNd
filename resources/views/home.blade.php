@extends('layouts.app')

@section('titre', 'Accueil')

@section('contenu')

    <div class="card">
        <h2 style="margin-top:0;">Bienvenue{{ auth()->check() ? ', ' . auth()->user()->nom : '' }} 👋</h2>
        <p style="color:var(--text-muted); font-size:13.5px;">
            Gérez vos catégories, produits et acheteurs depuis le menu latéral.
            @guest
                <br>Connectez-vous pour accéder aux fonctionnalités de gestion.
            @endguest
        </p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Catalogue produits</h2>
            <a href="{{ route('produits.index') }}" class="btn btn-outline btn-sm">Voir tout le catalogue →</a>
        </div>

        @if(isset($produits) && $produits->count())
            <table>
                <thead>
                    <tr><th>Produit</th><th>Catégorie</th><th>Prix</th><th>Stock</th></tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                        <tr>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ $produit->categorie->nom ?? '—' }}</td>
                            <td>{{ number_format($produit->prix, 2) }} €</td>
                            <td>{{ $produit->stock }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">Le catalogue s'affichera ici (variable <code>$produits</code> à passer depuis le contrôleur d'accueil).</div>
        @endif
    </div>

@endsection
