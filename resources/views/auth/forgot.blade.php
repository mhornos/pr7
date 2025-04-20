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
    
    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <h2>Canviar contrasenya:</h2><br>

    <form action="{{ route('password.send') }}" method="POST">
        @csrf
        <p>T'enviarem un correu per reiniciar la teva contrasenya</p><br>

        <input type="email" id="correu" name="correu" placeholder="El teu correu">
        <input type="submit" name="Enviar" value="Enviar">
    </form>

    <a href="{{ route('home') }}">
        <button>Tornar a inici</button>
    </a>


</body>
</html>
