<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
</head>
<body>
    <div class="overlay"></div>
    <div class="contenidor-formulari">
        <h2>Estàs segur que vols eliminar l'usuari amb ID {{ $usuari->ID }}?</h2>
        <form method="POST" action="{{ route('usuaris.eliminar') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $usuari->ID }}">
            <div class="buttons-container">
                <button type="submit" name="confirmar" value="Si" class="confirm-btn">Sí</button>
                <button type="submit" name="confirmar" value="No" class="cancel-btn">No</button>
            </div>
        </form>
    </div>
</body>
</html>
