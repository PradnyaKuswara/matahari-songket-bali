@props(['id' => 'btn-click', 'link' => 'javascript:void(0)', 'type' => 'button'])


<button type="{{ $type }}" id="{{ $id }}"
    {{ $attributes->merge(['class' => 'btn text-xs lg:text-xs ', 'href' => '']) }}>{{ $slot }}</button>
