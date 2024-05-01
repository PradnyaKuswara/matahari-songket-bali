@props(['modalId', 'title', 'description'])

<div id="modal-name-{{ $modalId }}" data-modal-target class="hidden">
    <div class="flex items-start justify-center fixed inset-0  z-[99]">
        <div data-modal-close data-modal-overlay tabindex="-1" data-class-out="opacity-0" data-class-in="opacity-50"
            class="opacity-0 fixed inset-0 w-full z-40 transition-opacity duration-300 bg-black select-none"></div>
        <div data-modal-wrapper data-class-out="opacity-0 translate-y-5" data-class-in="opacity-100 translate-y-0"
            class="opacity-0 translate-y-5 w-full z-50 overflow-auto max-w-md max-h-screen scrolling-touch transition-all duration-300 bg-white flex flex-col transform shadow-xl rounded-md m-5">
            <div class="flex items-center justify-between border-b p-6">
                <div>
                    {{ $title }}
                </div>
                <button data-modal-close aria-label="Close"
                    class="text-gray-700 hover:text-black focus:outline-none focus:text-black transition ease-in-out duration-150 ml-auto">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="relative overflow-x-hidden overflow-y-auto h-full flex-grow p-5">
                <p class="mb-4">
                    {{ $description }}
                </p>
                <div class="text-right">
                    <button data-modal-close class="underline">
                        Close Modal
                    </button>
                    or [esc] key
                </div>
            </div>
        </div>
    </div>
</div>
