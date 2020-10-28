@if ($paginator->hasPages())
    <div class="nav-links">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="prev" disabled>&lt;</a>
        @else
            <a class="prev" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="page-numbers current-page" disabled>{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="page-numbers current-page" disabled>{{ $page }}</a>
                    @else
                        <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="next" href="{{ $paginator->nextPageUrl() }}">&gt;</a>
        @else
            <a class="next" disabled>&gt;</a>
        @endif
    </div>
@endif
