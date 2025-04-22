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

    <h2>Eliminar vehicle de la BD</h2><br>

    <form action="{{ route('vehicle.esborrar.process') }}" method="POST">
        @csrf
        <input type="text" name="id" placeholder="Introdueix ID del teu vehicle a eliminar*" value="{{ old('id') }}"><br/>
        <input type="submit" value="Eliminar" name="Enviar">
        <input type="reset" value="Buidar">
    </form>

    <a href="{{ route('home', ['pagina' => request('pagina', 1)]) }}">
        <button>Tornar a inici</button>
    </a>

    <!-- paginacio -->
    {{ $articles->links('vendor.pagination.default') }}
    <br>

    <!-- resultats -->
    <div class="articles-container">
        @forelse ($articles as $article)
        <div class="article-box">
                <p>{{ $article->ID }}</p>
                <h3>{{ $article->marca }} {{ $article->model }}</h3>
                <p><strong>Any:</strong> {{ $article->any }}</p>
                <p><strong>Color:</strong> {{ $article->color }}</p>
                <p><strong>Matrícula:</strong> {{ $article->matricula }}</p>
                <p><strong>Mecànic:</strong> {{ $article->nom_usuari }}</p>
                <p><strong>Ciutat:</strong> {{ $article->usuari->ciutat}}</p>

                @if (!empty($article->imatge))
                    <img src="{{ $article->imatge }}" width="150" alt="imatge">
                @else
                    <p><br>No hi ha imatge</p>
                @endif
            </div>
        @empty
            <p>No s'han trobat vehicles.</p>
        @endforelse
    </div>

</body>
</html>
