<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
</head>
<body>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    
    <h2>Canviar contrasenya:</h2><br>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="password" name="contrasenya" placeholder="Contrasenya actual">
        <input type="password" name="contrasenyaNova1" placeholder="Nova contrasenya">
        <input type="password" name="contrasenyaNova2" placeholder="Confirmació nova contrasenya">
        <p>La contrasenya ha de tenir almenys 8 caràcters, un número, una majúscula i una minúscula.</p><br>
        <input type="submit" value="Canviar">
    </form>

    <a href="{{ route('home') }}">
        <button>Tornar a inici</button>
    </a>

</body>
</html>
