<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
</head>
<body>
    <h2>Gestionar usuaris:</h2><br>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Correu</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usuaris as $usuari)
                <tr>
                    <td>{{ $usuari->ID }}</td>
                    <td>{{ $usuari->nombreUsuario }}</td>
                    <td>{{ $usuari->correo }}</td>
                    <td>
                        <form action="{{ route('usuaris.confirmar') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $usuari->ID }}">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hi ha cap usuari registrat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    <a href="{{ route('home') }}">
        <button>Tornar a inici</button>
    </a>
</body>
</html>
