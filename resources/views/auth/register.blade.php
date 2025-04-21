<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
</head>
<body>
    <!-- missatges -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h2>Crear compte de mecànic:</h2><br>

    <form method="POST" action="{{ route('register.process') }}">
        @csrf

        <input type="text" id="usuari" name="nombreUsuario" placeholder="Usuari" value="{{ old('nombreUsuario') }}">

        <input type="email" id="correu" name="correo" placeholder="Correu" value="{{ old('correo') }}">

        <input type="text" id="ciutat" name="ciutat" placeholder="Ciutat" value="{{ old('ciutat') }}">

        <input type="text" id="imatge" name="imatge" placeholder="Enllaç de imatge (opcional)" value="{{ old('imatge') }}">

        <input type="password" id="contrasenya" name="contrasenya" placeholder="Contrasenya">

        <input type="password" id="contrasenya2" name="contrasenya2" placeholder="Repeteix la contrasenya">

        <p>La contrasenya ha de tenir almenys 8 caràcters, un número, una majúscula i una minúscula.</p><br>

        <input type="submit" name="Register" value="Register">

        <p>Ja tinc un compte: <a href="{{ route('login') }}">Iniciar sessió</a></p>
    </form>

    <a href="{{ route('home', ['pagina' => request('pagina', 1)]) }}">
        <button>Tornar a inici</button>
    </a>
</body>
</html>
