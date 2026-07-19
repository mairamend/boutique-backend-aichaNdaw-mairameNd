@extends('layouts.app')

@section('titre', $acheteur->nom)

@section('topbar-actions')
@can('update',$acheteur)
 <a href="{{ route('acheteurs.edit', $acheteur) }}" class="btn btn-outline">Modifier</a>
@endcan
@endsection

@section('contenu')
<div class="breadcrumb"><a href="{{ route('acheteurs.index') }}">← Acheteurs</a></div>

    <div class="card">
        <h2 style="margin-top:0;">{{ $acheteur->nom }}</h2>
        <div style="display:flex; gap:36px; color:var(--text-muted); font-size:13.5px;">
            <div>📧 {{ $acheteur->email }}</div>
            <div>📞 {{ $acheteur->telephone ?: '—' }}</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h2>Enregistrer un nouvel achat</h2></div>

        {{-- Hypothèse : route POST acheteurs.achats.store -> /acheteurs/{acheteur}/acheter --}}
        <form action="{{route('acheteurs.acheter', $acheteur) }}" method="POST">
            @csrf
            <div style="display:flex; gap:14px; align-items:flex-end; flex-wrap:wrap;">
                <div class="form-group" style="flex:2; min-width:200px; margin-bottom:0;">
                    <label for="produit_id">Produit</label>
                    <select id="produit_id" name="produit_id" required>
                        <option value="">— Choisir un produit —</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">{{ $produit->nom }} ({{ number_format($produit->prix, 2) }} €)</option>
                        @endforeach
                    </select>
                    @error('produit_id') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group" style="flex:1; min-width:100px; margin-bottom:0;">
                    <label for="quantite">Quantité</label>
                    <input type="number" id="quantite" name="quantite" min="1" value="1" required>
                    @error('quantite') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group" style="flex:1; min-width:150px; margin-bottom:0;">
                    <label for="date_achat">Date</label>
                    <input type="date" id="date_achat" name="date_achat" value="{{ date('Y-m-d') }}" required>
                    @error('date_achat') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="height:41px;">Enregistrer</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header"><h2>Historique des achats</h2></div>
        @if($acheteur->achats->count())
            <table>
                <thead>
                    <tr><th>Produit</th><th>Quantité</th><th>Date</th></tr>
                </thead>
                <tbody>
                    @foreach($acheteur->achats as $achat)
                        <tr>
                            <td>{{ $achat->produit->nom ?? '—' }}</td>
                            <td>{{ $achat->quantite }}</td>
                            <td>{{ $achat->date_achat->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">Aucun achat enregistré pour cet acheteur.</div>
        @endif
    </div>
@endsection
