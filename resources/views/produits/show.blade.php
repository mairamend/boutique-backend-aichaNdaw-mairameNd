@extends('layouts.app')
@section('titre', $produit->nom)
@section('topbar-actions')
@can('update',$produit)
    <a href="{{ route('produits.edit', $produit) }}" class="btn btn-outline">Modifier</a>
@endcan
@endsection

@section('contenu')
<div class="breadcrumb"><a href="{{ route('produits.index') }}">← Produits</a></div>

<div class="card">
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <div>
                <h2 style="margin-top:0;">{{ $produit->nom }}</h2>
                <p style="color:var(--text-muted); max-width:520px;">{{ $produit->description ?: 'Aucune description.' }}</p>
            </div>
            <span class="badge badge-gestionnaire">{{ $produit->categorie->nom ?? 'Sans catégorie' }}</span>
        </div>
        <div style="display:flex; gap:36px; margin-top:14px;">
            <div>
                <div style="font-size:11px; color:var(--text-muted); text-transform:uppercase;">Prix</div>
                <div style="font-size:20px; font-weight:700;">{{ number_format($produit->prix, 2) }} FCFA</div>
            </div>
            <div>
                <div style="font-size:11px; color:var(--text-muted); text-transform:uppercase;">Stock</div>
                <div style="font-size:20px; font-weight:700;">{{ $produit->stock }}</div>
            </div>
        </div>
    </div>
    @auth
        <div class="card">
            <div class="card-header"><h2>Acheteurs de ce produit</h2></div>
            @if($produit->achats->count())
                <table>
                    <thead>
                        <tr><th>Acheteur</th><th>Quantité</th><th>Date</th></tr>
                    </thead>
                    <tbody>
                        @foreach($produit->achats as $achat)
                            <tr>
                                <td>{{ $achat->acheteur->nom ?? '—' }}</td>
                                <td>{{ $achat->quantite }}</td>
                                <td>{{ $achat->date_achat->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">Ce produit n'a pas encore été acheté.</div>
            @endif
        </div>
    @endauth
@endsection
