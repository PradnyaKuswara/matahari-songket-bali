{{-- @props(['link']) --}}

<a {{ $attributes->merge(['class' => 'btn']) }}>{{ $slot }}</a>
