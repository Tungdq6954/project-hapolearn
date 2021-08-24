@if ($paginator->hasPages())
    <div>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span
                        class="pagination-arrow-button d-flex align-items-center justify-content-center"><i
                            class="fas fa-arrow-left"></i></span></li>
            @else
                <li>
                    <a class="pagination-arrow-button pagination-arrow-button-hover d-flex align-items-center justify-content-center"
                        href="{{ $paginator->previousPageUrl() }}">
                        <span><i class="fas fa-arrow-left"></i></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span
                                    class="page-button-active d-flex align-items-center justify-content-center">{{ $page }}</span>
                            </li>
                        @else
                            <li><a href="{{ $url }}"
                                    class="page-button d-flex align-items-center justify-content-center">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @else
                    <li class="disabled d-flex align-items-center"><span><i class="fa fa-ellipsis-h"></i></span></li>
                @endif
            @endforeach


            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="pagination-arrow-button pagination-arrow-button-hover d-flex align-items-center justify-content-center"
                        href="{{ $paginator->nextPageUrl() }}">
                        <span><i class="fas fa-arrow-right"></i></span>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span class="pagination-arrow-button d-flex align-items-center justify-content-center"><i
                            class="fas fa-arrow-right"></i></i></span>
                </li>
            @endif
        </ul>
    </div>
@endif
