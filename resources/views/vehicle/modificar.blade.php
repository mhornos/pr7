<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
</head>
<body>
    <h2>Modificar un vehicle</h2>

    <form method="POST" action="{{ route('vehicle.processarModificacio') }}">
        @csrf
        <input type="hidden" name="id" value="1"> 
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="model" placeholder="Model" required>
        <input type="number" name="any" placeholder="Any" required>
        <input type="text" name="color" placeholder="Color" required>
        <input type="text" name="imatge" placeholder="URL imatge (opcional)">
        <button type="submit">Desar canvis</button>
    </form>

</body>
</html>