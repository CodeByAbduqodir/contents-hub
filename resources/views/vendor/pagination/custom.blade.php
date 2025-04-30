@if ($paginator->hasPages())
<div class="pagination-container mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div class="pagination-info text-sm text-gray-600 mb-4 sm:mb-0">
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination flex flex-row items-center gap-2">
            @if ($paginator->onFirstPage())
                <li class="px-3 py-2 text-gray-400 border border-gray-300 rounded-md cursor-not-allowed">Previous</li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100">Previous</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="px-3 py-2 text-gray-400">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-3 py-2 bg-blue-500 text-white border border-blue-500 rounded-md">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}" class="px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 bg-white text-gray-700 border border-gray-300 rounded-md hover:bg-gray-100">Next</a></li>
            @else
                <li class="px-3 py-2 text-gray-400 border border-gray-300 rounded-md cursor-not-allowed">Next</li>
            @endif
        </ul>
    </nav>
</div>
@endif
