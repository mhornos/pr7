<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
    </head>
<body>
    <h2>Registre</h2>
    <form method="POST" action="{{ route('register.process') }}">
        @csrf
        <input type="text" name="nombreUsuario" placeholder="Usuari" required>
        <input type="email" name="correo" placeholder="Correu" required>
        <input type="text" name="ciutat" placeholder="Ciutat" required>
        <input type="password" name="contrasenya" placeholder="Contrasenya" required>
        <button type="submit">Registrar-se</button>
    </form>
    <p>Ja tens un compte? <a href="{{ route('login') }}">Inicia sessió</a></p>
    <p><a href="{{ route('home') }}">Tornar a l'inici</a></p>

</body>
</html>