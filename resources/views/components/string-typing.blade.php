@props(['text', 'idType', 'idStringElement'])

<div id="{{ $idStringElement }}" class="mb-5">
    <span>{{ $slot }}</span>
</div>
<span id="{{ $idType }}" {{ $attributes->merge(['class' => '']) }}></span>

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script type="module">
        const typed = new Typed('#{{ $idType }}', {
            stringsElement: '#{{ $idStringElement }}',
            loop: true,
            loopCount: Infinity,
            typeSpeed: 50,
            backSpeed: 50,
        });
    </script>
@endpush
