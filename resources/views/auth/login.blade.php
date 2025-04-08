<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
    </head>
<body>
    <h2>Login</h2>
    <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <input type="text" name="nombreUsuario" placeholder="Usuari" required>
        <input type="password" name="contrasenya" placeholder="Contrasenya" required>
        <button type="submit">Entrar</button>
    <p>No tens compte? <a href="{{ route('register') }}">Registra't</a></p>
    </form>
    <p><a href="{{ route('home') }}">Tornar a l'inici</a></p>

</body>
</html>