@if ($paginator->hasPages())
    <ul class="flex items-center space-x-1 rtl:space-x-reverse m-auto mb-4 justify-between md:mx-4" role="navigation"
        aria-label="{{ __('Pagination Navigation') }}">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-bold text-neutral dark:text-white">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-bold text-neutral dark:text-white">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-bold text-neutral dark:text-white">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>
        </div>

        <div class="flex gap-2">
            @if ($paginator->onFirstPage())
                <li><button type="button"
                        class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-neutral text-white hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">Prev</button>
                </li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="{{ __('pagination.previous') }}"
                        class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-neutral text-white hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">Prev</a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="prev"
                        aria-label="{{ __('pagination.previous') }}"
                        class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-neutral text-white hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">Next</a>
                </li>
            @else
                <li><button type="button"
                        class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-neutral text-white hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">Next</button>
                </li>
            @endif
        </div>
    </ul>
@endif
