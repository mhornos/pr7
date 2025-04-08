<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mhornos</title>
    <link rel="stylesheet" href="{{ asset('estils.css') }}">
    </head>
<body>
    <h1>Mecànic Admin de Garatges</h1><br>

    <!-- navbar -->
    @include('components.navbar')

    <!-- filtres -->
    <div class="controls-container">
        <form method="GET" class="controls">
            <input type="text" name="cercaCriteri" value="{{ request('cercaCriteri') }}" placeholder="Introdueix el text per buscar:">
            <button type="submit">Cercar</button>
        </form>

        <form method="GET" class="controls">
            <label for="resultatsPerPagina">Articles per pàgina:</label>
            <select name="resultatsPerPagina" id="resultatsPerPagina">
                @foreach ([5, 10, 15, 20, 25] as $opcio)
                    <option value="{{ $opcio }}" {{ request('resultatsPerPagina', 5) == $opcio ? 'selected' : '' }}>
                        {{ $opcio }}
                    </option>
                @endforeach
            </select>

            <label for="orden">Ordenar per:</label>
            <select name="orden" id="orden">
                @php
                    $opcionsOrdenacio = [
                        'any_asc' => 'Any (Ascendent)',
                        'any_desc' => 'Any (Descendent)',
                        'marca_asc' => 'Marca (Ascendent)',
                        'marca_desc' => 'Marca (Descendent)',
                        'model_asc' => 'Model (Ascendent)',
                        'model_desc' => 'Model (Descendent)',
                    ];
                @endphp
                @foreach ($opcionsOrdenacio as $valor => $etiqueta)
                    <option value="{{ $valor }}" {{ request('orden') == $valor ? 'selected' : '' }}>
                        {{ $etiqueta }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Aplicar</button>
        </form>
    </div>
    
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
                <p><strong>Ciutat:</strong> {{ $article->ciutat }}</p>

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

