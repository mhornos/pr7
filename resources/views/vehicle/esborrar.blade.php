<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
</head>
<body>
    <h2>Esborrar un vehicle</h2>
    
    <form method="POST" action="{{ route('vehicle.processarEsborrat') }}">
        @csrf
        <input type="text" name="matricula" placeholder="Matrícula del vehicle a eliminar" required>
        <button type="submit">Eliminar vehicle</button>
    </form>

</body>
</html>