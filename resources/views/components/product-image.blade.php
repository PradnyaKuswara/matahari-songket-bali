@props(['src'])

<button onclick="{{ $attributes->get('onclick') }}" class="hover:opacity-75 hover:animate-normal rounded-lg aspect-video border">
    <img class="w-full h-full object-contain" src="{{ $src }}" alt="" class="w-full h-full">
</button>
<dialog {{ $attributes->merge(['id' => '']) }} class="modal">
    <div class="modal-box p-0 max-w-screen-lg overflow-auto rounded-lg">
        <img src="{{ $src }}" alt="" class="w-full h-full object-cover">
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
