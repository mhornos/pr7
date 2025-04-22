<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <link rel="stylesheet" href="{{ asset('estils.css') }}">
</head>
<body>
    <!-- mostrar errors si hi ha -->
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <br><h2>Inicia sessió:</h2>

    <br><form method="POST" action="{{ route('login.process') }}">
        @csrf

        <input type="text" name="usuari" placeholder="Usuari" value="{{ old('usuari', obtenirCookie('usuari')) }}">

        <input type="password" name="contrasenya" placeholder="Contrasenya" value="{{ obtenirCookie('contrasenya') }}">

        <!-- si l'usuari ha fallat 3 vegades, mostrar reCAPTCHA -->
        @if(session('intentsFallats', 0) >= 3)
            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
        @endif
        <br>

        <input type="submit" name="Login" value="Login">

        <input type="checkbox" name="remember_me" value="1"
            {{ obtenirCookie('usuari') ? 'checked' : '' }}> Recordar-me </br>

        No tinc compte: <a href="{{ route('register') }}">Crea un compte</a><br>
        He oblidat la contrasenya: <a href="{{ route('password.cambiar') }}">Recuperar-la</a><br><br>
    </form>

    <br><a href="{{ route('home', ['pagina' => request('pagina', 1)]) }}">
        <button>Tornar a inici</button>
    </a><br>

</body>
</html>
