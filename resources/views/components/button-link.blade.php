@props(['title', 'description', 'image', 'badges', 'link' => 'javascript:void(0)'])


<a href="{{ $link }}"
    {{ $attributes->merge(['class' => 'btn text-xs lg:text-base ', 'href' => '']) }}>{{ $slot }}</a>
