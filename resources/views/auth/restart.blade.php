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
        <div class="errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h2>Canviar contrasenya:</h2><br>

    <form action="{{ route('password.restart.process', ['token' => $token]) }}" method="POST">
        @csrf
        <p>Introdueix la nova contrasenya:</p><br>
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="password" name="contrasenya" placeholder="Contrasenya">
        <input type="password" name="contrasenya2" placeholder="Repeteix la contrasenya">
        <p>La contrasenya ha de tenir almenys 8 caràcters, un número, una majúscula i una minúscula.</p><br>
        <input type="submit" value="Canviar">
    </form>
</body>
</html>
