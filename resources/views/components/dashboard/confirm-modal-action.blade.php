@props(['modalId', 'title', 'description'])

<!-- modal -->
<div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
    <div class="flex items-center justify-center min-h-screen px-4" @click.self="open = false">
        <div x-show="open" x-transition x-transition.duration.300
            class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
            <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                <h5 class="font-bold text-lg">{{ $title }}</h5>
            </div>
            <div class="p-5">
                <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                    <p>{{ $description }}</p>
                </div>
                <div class="flex justify-end items-center mt-8">
                    <button type="button" class="btn btn-outline btn-accent border-none btn-sm" @click="toggle">Discard</button>
                    <button type="submit" class="btn btn-primary border-none btn-sm ltr:ml-4 rtl:mr-4" @click="toggle">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("modal", (initialOpenState = false) => ({
                open: initialOpenState,

                toggle() {
                    this.open = !this.open;
                },
            }));
        });
    </script>
@endpush
