@if ($paginator->hasPages())
    <!-- Pagination -->
    <div>
        <ul class="pagination justify-content-end mt-4">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span class="pagination-arrow-button page-button d-flex align-items-center justify-content-center"><i class="fas fa-arrow-left"></i></span>
                </li>
            @else
                <li>
                    <a class="pagination-arrow-button page-button d-flex align-items-center justify-content-center" href="{{ $paginator->previousPageUrl() }}">
                        <span><i class="fas fa-arrow-left"></i></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="page-button-active d-flex align-items-center justify-content-center">{{ $page }}</span></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li><a href="{{ $url }}" class="page-button d-flex align-items-center justify-content-center">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li class="disabled d-flex align-items-center"><span><i class="fa fa-ellipsis-h"></i></span></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="pagination-arrow-button page-button d-flex align-items-center justify-content-center" href="{{ $paginator->nextPageUrl() }}">
                        <span><i class="fas fa-arrow-right"></i></span>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span class="pagination-arrow-button page-button d-flex align-items-center justify-content-center"><i class="fas fa-arrow-right"></i></i></span>
                </li>
            @endif
        </ul>
    </div>
    <!-- Pagination -->
@endif
