@props(['paginator'])

@if ($paginator->hasPages())
    <nav class="flex justify-center mt-6" role="navigation" aria-label="Pagination Navigation">
        <ul class="inline-flex items-center -space-x-px">
            @if ($paginator->onFirstPage())
                <li>
                    <span
                        class="px-3 py-1 ml-0 leading-tight text-gray-400 bg-gray-200 rounded-l-lg cursor-not-allowed">
                        上一页
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-1 ml-0 leading-tight text-gray-700 bg-white border rounded-l-lg hover:bg-gray-100 hover:text-gray-900">
                        上一页
                    </a>
                </li>
            @endif

            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li>
                        <span class="px-3 py-1 text-white bg-blue-600 border border-blue-600">{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $url }}"
                           class="px-3 py-1 text-gray-700 bg-white border hover:bg-gray-100 hover:text-gray-900">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-1 leading-tight text-gray-700 bg-white border rounded-r-lg hover:bg-gray-100 hover:text-gray-900">
                        下一页
                    </a>
                </li>
            @else
                <li>
                    <span class="px-3 py-1 leading-tight text-gray-400 bg-gray-200 rounded-r-lg cursor-not-allowed">
                        下一页
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
