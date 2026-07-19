<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('titre', 'Gestion de boutique')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <span class="dot"></span> Boutique
            </div>
            <div class="nav-section-label">Général</div>
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <span class="nav-icon">🏠</span> Accueil
            </a>
             <a href="{{ route('produits.index') }}" class="nav-link {{ request()->routeIs('produits.*') ? 'active' : '' }}">
                <span class="nav-icon">📦</span> Produits
            </a>
            @auth
            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <span class="nav-icon">🗂️</span> Catégories
            </a>
            <a href="{{ route('acheteurs.index') }}" class="nav-link {{ request()->routeIs('acheteurs.*') ? 'active' : '' }}">
                <span class="nav-icon">🧑‍🤝‍🧑</span> Acheteurs
            </a>
            @can('create', \App\Models\Utilisateur::class)
                <div class="nav-section-label">Gestion</div>
            @endcan
            @can('viewAny', App\Models\Utilisateur::class)
                <a href="{{ route('utilisateurs.index') }}" class="nav-link {{ request()->routeIs('utilisateur.*') ? 'active' : '' }}">
                    <span class="nav-icon">⚙️</span> Utilisateurs &amp; rôles
                </a>
            @endcan
            @endauth
             
               
            <div class="sidebar-footer">
            @auth
                <div class="user-chip">
                    <span class="name">{{ auth()->user()->nom }}</span>
                    <span class="role">{{ auth()->user()->role }}</span>
                    <a href="{{ route('profil.edit') }}" class="nav-link {{ request()->routeIs('profil.*') ? 'active' : '' }}" style="margin-bottom:0.4rem;">
                    <span class="nav-icon">🔑</span> Mon profil
                </a>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Se déconnecter</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%; justify-content:center;">Connexion</a>
            @endauth
        </div>
        </aside>
  
    

    <div class="main">
        <div class="topbar">
            <div style="display:flex; align-items:center; gap:14px;">
                <button class="burger" onclick="document.getElementById('sidebar').classList.toggle('open')">☰</button>
                <h1>@yield('titre', 'Accueil')</h1>
            </div>
            @yield('topbar-actions')
        </div>
        <div class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @yield('contenu')
        </div>
    </div>
     </div> 
</body>
</html>