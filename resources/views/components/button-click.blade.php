@props(['title', 'description', 'image', 'badges', 'link' => 'javascript:void(0)'])


<button {{ $attributes->merge(['class' => 'btn text-xs lg:text-xs ', 'href' => '']) }}>{{ $slot }}</button>
