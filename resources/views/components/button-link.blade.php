@props(['title', 'description', 'image', 'badges', 'link' => 'javascript:void(0)'])


<a href="{{ $link }}"
    {{ $attributes->merge(['class' => 'btn ', 'href' => '']) }}>{{ $slot }}</a>
