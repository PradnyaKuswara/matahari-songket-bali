@props(['text', 'idType', 'idStringElement'])

<div id="{{ $idStringElement }}" class="mb-5">
    <span>{{ $slot }}</span>
</div>
<span id="{{ $idType }}" {{ $attributes->merge(['class' => '']) }}></span>

@push('scripts')
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
