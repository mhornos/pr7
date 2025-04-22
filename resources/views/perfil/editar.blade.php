<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
</head>
<body>
    <h2>Editar perfil:</h2><br>

    @if ($errors->any())
        <div class="errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('perfil.editar.process') }}" method="POST">
        @csrf

        <div class="imatge-editar">
            <img src="{{ obtenirImatge(session('usuari')) }}" alt="">
        </div><br>

        <p>Editar nom d'usuari:</p>
        <input type="text" name="usuari" placeholder="Nom d'usuari" value="{{ old('usuari', $usuari->nombreUsuario) }}">

        <p>Editar correu electrònic:</p>
        <input type="email" name="correu" placeholder="Correu" value="{{ old('correu', $usuari->correo) }}">

        <p>Editar ciutat:</p>
        <input type="text" name="ciutat" placeholder="Ciutat" value="{{ old('ciutat', $usuari->ciutat) }}">

        <p>Editar imatge:</p>
        <input type="text" name="imatge" placeholder="Enllaç d'imatge" value="{{ old('imatge', $usuari->imatge !== 'imgs/senseFoto.png' ? $usuari->imatge : '') }}">

        <input type="submit" value="Editar">
    </form>

    <a href="{{ route('home', ['pagina' => request('pagina', 1)]) }}">
        <button>Tornar a inici</button>
    </a>
</body>
</html>
