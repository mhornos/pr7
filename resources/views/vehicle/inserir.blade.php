<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
</head>
<body>
    <h2>Inserir vehicle nou</h2>
    
    <form method="POST" action="{{ route('vehicle.processarInsercio') }}">
        @csrf
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="model" placeholder="Model" required>
        <input type="number" name="any" placeholder="Any" required>
        <input type="text" name="color" placeholder="Color" required>
        <input type="text" name="matricula" placeholder="Matrícula" required>
        <input type="text" name="imatge" placeholder="URL imatge (opcional)">
        <button type="submit">Inserir</button>
    </form>

</body>
</html>