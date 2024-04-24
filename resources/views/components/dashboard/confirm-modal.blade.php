@props(['title', 'description'])

<div class="hidden w-full h-full fixed top-0 start-0 z-50 transition-all duration-500">
    <div
        class="fc-modal-open:mt-7 fc-modal-open:opacity-100 fc-modal-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="flex flex-col bg-white border shadow-sm rounded-xl">
            <div class="flex justify-between items-center py-2.5 px-4 border-b">
                <h3 class="font-bold text-gray-800">
                    {{ $title }}
                </h3>
                <button data-fc-dismiss type="button"
                    class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 rounded-md text-gray-500 hover:text-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-white transition-all text-sm">
                    <span class="sr-only">Close</span>
                    <i class="bx bx-x text-xl"></i>
                </button>
            </div>
            <div class="p-4 overflow-y-auto">
                <p class="mt-1 text-gray-800">
                    {{ $description }}
                </p>
            </div>
            <div class="flex justify-end items-center gap-x-2 py-2.5 px-4 border-t">
                <button data-fc-dismiss type="button" class="btn bg-secondary text-white">
                    Close
                </button>
                <button type="submit" class="btn bg-primary text-white">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
