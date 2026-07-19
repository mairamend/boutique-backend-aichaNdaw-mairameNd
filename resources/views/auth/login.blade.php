<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Boutique</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f5f6fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .auth-card {
            background: #fff;
            border: 1px solid #ececf1;
            border-radius: 12px;
            padding: 36px;
            width: 100%;
            max-width: 380px;
        }
        .auth-brand { display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 18px; margin-bottom: 26px; }
        .auth-brand .dot { width: 9px; height: 9px; border-radius: 3px; background: #4f46e5; }
        h1 { font-size: 18px; margin: 0 0 6px 0; }
        p.sub { color: #8a8f9a; font-size: 13.5px; margin: 0 0 22px 0; }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; }
        input[type=email], input[type=password] {
            width: 100%; padding: 10px 12px; border: 1px solid #ececf1; border-radius: 8px; font-size: 13.5px; box-sizing: border-box;
        }
        input:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 3px #eef0fd; }
        .field-error { color: #e5484d; font-size: 12px; margin-top: 4px; }
        .checkbox-row { display: flex; align-items: center; gap: 8px; font-size: 13px; margin-bottom: 20px; }
        .btn-primary {
            width: 100%; background: #4f46e5; color: #fff; border: none; padding: 11px; border-radius: 8px;
            font-weight: 600; font-size: 14px; cursor: pointer;
        }
        .btn-primary:hover { background: #4338ca; }
        .switch-link { text-align: center; margin-top: 18px; font-size: 13px; color: #8a8f9a; }
        .switch-link a { color: #4f46e5; font-weight: 600; text-decoration: none; }
        .alert-error { background: #fdeded; color: #e5484d; border: 1px solid #f6c9ca; padding: 10px 14px; border-radius: 8px; font-size: 13px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-brand"><span class="dot"></span> Boutique</div>
        <h1>Connexion</h1>
        <p class="sub">Accédez à votre espace de gestion.</p>

        @if ($errors->any())
            <div class="alert-error">Identifiants incorrects ou champs invalides.</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                @error('password') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="checkbox-row">
                <input type="checkbox" id="remember" name="remember" style="width:auto;">
                <label for="remember" style="margin:0; font-weight:400;">Se souvenir de moi</label>
            </div>
            <button type="submit" class="btn-primary">Se connecter</button>
        </form>

        
    </div>
</body>
</html>
