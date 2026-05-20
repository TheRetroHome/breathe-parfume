@if ($paginator->hasPages())
<nav class="flex items-center justify-between" aria-label="Pagination">
    <p class="text-sm text-dark-500 font-body">
        Страница {{ $paginator->currentPage() }} из {{ $paginator->lastPage() }}
    </p>

    <div class="flex items-center gap-1">
        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-dark-700 border border-dark-800 cursor-not-allowed text-sm font-body">←</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-dark-400 border border-dark-700 hover:border-gold-500 hover:text-gold-400 transition-colors text-sm font-body">←</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-2 text-dark-600 text-sm font-body">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 bg-gold-500 text-dark-950 text-sm font-body font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 text-dark-400 border border-dark-700 hover:border-gold-500 hover:text-gold-400 transition-colors text-sm font-body">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-dark-400 border border-dark-700 hover:border-gold-500 hover:text-gold-400 transition-colors text-sm font-body">→</a>
        @else
            <span class="px-4 py-2 text-dark-700 border border-dark-800 cursor-not-allowed text-sm font-body">→</span>
        @endif
    </div>
</nav>
@endif
