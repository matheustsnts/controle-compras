@if ($paginator->hasPages())
    <ul class="pagination pagination-sm m-0 float-right">
        {{-- Página Anterior --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"> <a href="#" class="page-link">«</a> </li>
        @else
            <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link">«</a></li>
        @endif

        {{-- Elementos da Paginação --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled">{{ $element }}</li>
            @endif

            {{-- A quantidade de páginas mostradas por link --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item disabled">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Próxima página --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link">»</a></li>
        @else
            <li class="page-item disabled"><a href="#" class="page-link">»</a></li>
        @endif
    </ul>
@endif
