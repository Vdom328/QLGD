<div class="pagination justify-content-start mt-4 fw-bold">
    @if ($paginator->hasPages())
        <nav class="d-flex justify-items-center justify-content-between">
            <div class="d-flex justify-content-between flex-fill d-sm-none">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">@lang('pagination.previous')</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                                rel="prev">@lang('pagination.previous')</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                                rel="next">@lang('pagination.next')</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">@lang('pagination.next')</span>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                <div>
                    <p class="small text-muted">
                        <span> 全 </span>
                        <span class="fw-semibold">{{ $paginator->total() }}</span>
                        <span> 件中 </span>
                        <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                        <span> 件～ </span>
                        <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                        <span> 件を表示 </span>
                    </p>
                </div>

                <div>
                    <ul class="pagination ms-2">
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="page-item  disabled" aria-disabled="true">
                                <span class="page-link rounded-circle" aria-hidden="true">＜前へ</span>
                            </li>
                        @else
                            <li class="page-item ">
                                <a class="page-link rounded-circle" href="{{ $paginator->previousPageUrl() }}"
                                    rel="prev">＜前へ</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <li class="page-item disabled" aria-disabled="true"><span
                                        class="page-link rounded-circle">{{ $element }}</span></li>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item  active" aria-current="page"><span
                                                class="page-link rounded-circle">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item "><a class="page-link rounded-circle"
                                                href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link rounded-circle" href="{{ $paginator->nextPageUrl() }}"
                                    rel="next" >次へ＞</a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true" >
                                <span class="page-link rounded-circle" aria-hidden="true">次へ＞</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    @endif
</div>
<style>
    span.page-link.rounded-circle {
        padding: 0px 5px;
        margin: 0px 7px;
        background: white;
        color: black;
        font-size: 12px;
        border: 1px solid;
    }

    a.page-link.rounded-circle {
        padding: 0px 5px;
        margin: 0px 7px;
        background: white;
        color: black;
        font-size: 12px;
        border: 1px solid;
    }

    .page-item.active .page-link,
    .pagination .active.page-number .page-link {
        color: #fff;
        background-color: black;
        border-color: black;
    }
    .page-link.rounded-circle {
        border-radius: 30px !important;
    }
</style>
