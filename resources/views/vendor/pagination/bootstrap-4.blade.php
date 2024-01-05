@if (1)
{{-- @if ($paginator->hasPages())  --}}
@php
    $urlAdd = '';
    if(@$routename == "employee"){
        if(@$event_cd > 0){
            $urlAdd .= '&event_code='.$event_cd;
        }
        if(@$level_code > 0){
            $urlAdd .= '&level_code='.$level_code;
        }
        if(@$hotel_code > 0){
            $urlAdd .= '&hotel_code='.$hotel_code;
        }
        if(@$list_length > 10){
            $urlAdd .= '&length='.$list_length;
        }
        if(strlen(trim(@$list_search)) > 0){
            $urlAdd .= '&search='.$list_search;
        }
    }
@endphp
<div class="row">
    <div class="col-sm-9">
        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">&lsaquo;&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl().$urlAdd }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;&lsaquo;</a>
                    </li>
                @endif
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url.$urlAdd }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl().$urlAdd }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">&rsaquo;&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    @php
    $showDetails = 'Y';
    if(@$showInfo == 'N'){
        $showDetails = 'N';
    }
    @endphp
    @if(@$showDetails == 'Y')
    <div class="col-sm-3">
        <div class="pagination float-right">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>
    </div>
    @endif
</div>
@endif
