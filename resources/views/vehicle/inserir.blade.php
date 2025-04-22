<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
</head>
<body>
    <h2>Inserir vehicle a la BD</h2><br>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('vehicle.inserir.process') }}" method="POST">
        @csrf
        <table>
            <input type="text" name="marca" placeholder="Marca*" value="{{ old('marca') }}">
            <input type="text" name="model" placeholder="Model*" value="{{ old('model') }}">
            <input type="number" name="any" placeholder="Any*" value="{{ old('any') }}" max="{{ date('Y') }}">
            <input type="text" name="color" placeholder="Color*" value="{{ old('color') }}">
            <input type="text" name="matricula" placeholder="Matrícula*" value="{{ old('matricula') }}">
            <input type="text" name="imatge" placeholder="Enllaç imatge (opcional)" value="{{ old('imatge') }}">
            <input type="submit" value="Inserir" name="Enviar">
            <input type="reset" value="Buidar">
        </table>
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
