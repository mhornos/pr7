<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
</head>
<body>
    <h2>Canvia la teva contrasenya</h2>

    <form method="POST" action="{{ route('password.process') }}">
        @csrf
        <input type="password" name="contrasenya_actual" placeholder="Contrasenya actual" required>
        <input type="password" name="nova_contrasenya" placeholder="Nova contrasenya" required>
        <input type="password" name="nova_contrasenya_confirmation" placeholder="Confirma la nova contrasenya" required>
        <button type="submit">Canviar</button>
    </form>
    
</body>
</html>