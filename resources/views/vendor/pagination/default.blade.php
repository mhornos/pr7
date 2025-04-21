@if ($paginator->hasPages())
    <div class="paginacio">
        <!-- boto anterior -->
        @if ($paginator->onFirstPage())
            <!-- desactivat -->
        @else
            <a href="{{ $paginator->previousPageUrl() }}">Anterior</a>
        @endif

        <!-- enllaços de pagina -->
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($i == $paginator->currentPage())
                <strong>{{ $i }}</strong>
            @else
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            @endif
        @endfor

        <!-- boto següent -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Següent</a>
        @endif
    </div>
@endif
