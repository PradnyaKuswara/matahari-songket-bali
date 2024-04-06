<button onclick="{{ $attributes->get('onclick') }}" class="hover:opacity-75 hover:animate-normal">
    <img src="{{ asset('assets/images/hero2.jpg') }}" alt="" class="w-full rounded-md">
</button>
<dialog {{ $attributes->merge(['id' => '']) }} class="modal">
    <div class="modal-box p-0 max-w-screen-lg overflow-hidden">
        <img src="{{ asset('assets/images/hero2.jpg') }}" alt="" class="rounded-md">
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
