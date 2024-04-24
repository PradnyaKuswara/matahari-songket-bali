@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between mt-4">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <button class="join-item btn bg-neutral text-neutral-content hover:text-black btn-sm w-20"
                    aria-disabled="true" aria-label="{{ __('pagination.previous') }}">Previous</button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    aria-label="{{ __('pagination.previous') }}">
                    <button
                        class="join-item btn bg-neutral text-neutral-content hover:text-black btn-sm w-20">Previous</button>
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    aria-label="{{ __('pagination.next') }}">
                    <button
                        class="join-item btn bg-neutral text-neutral-content hover:text-black btn-sm w-20">Next</button>
                </a>
            @else
                <button class="join-item btn bg-neutral text-neutral-content hover:text-black btn-sm w-20"
                    aria-disabled="true" aria-label="{{ __('pagination.next') }}">Next</button>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-bold text-neutral">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-bold text-neutral ">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-bold text-neutral ">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <div class="">
                    @if ($paginator->onFirstPage())
                        <button class="join-item btn bg-neutral text-neutral-content hover:text-black btn-sm w-20"
                            aria-disabled="true" aria-label="{{ __('pagination.previous') }}">Previous</button>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            aria-label="{{ __('pagination.previous') }}">
                            <button
                                class="join-item btn bg-neutral text-neutral-content hover:text-black btn-sm w-20">Previous</button>
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            aria-label="{{ __('pagination.next') }}">
                            <button
                                class="join-item btn bg-neutral text-neutral-content hover:text-black btn-sm w-20">Next</button>
                        </a>
                    @else
                        <button class="join-item btn bg-neutral text-neutral-content hover:text-black btn-sm w-20"
                            aria-disabled="true" aria-label="{{ __('pagination.next') }}">Next</button>
                    @endif
                </div>
            </div>
        </div>
    </nav>
@endif
