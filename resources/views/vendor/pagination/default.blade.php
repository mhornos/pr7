@if ($paginator->hasPages())
    <div class="paginacio">
        {{-- Botón anterior --}}
        @if ($paginator->onFirstPage())
            {{-- Desactivado --}}
        @else
            <a href="{{ $paginator->previousPageUrl() }}">Anterior</a>
        @endif

        {{-- Enlaces de página --}}
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($i == $paginator->currentPage())
                <strong>{{ $i }}</strong>
            @else
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            @endif
        @endfor

        {{-- Botón siguiente --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Següent</a>
        @endif
    </div>
@endif
